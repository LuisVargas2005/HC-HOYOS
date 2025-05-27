<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use App\Models\Product;

class ShoppingCart extends Component
{
    public $items = [];
    protected $listeners = ['addToCart'];

    public function mount()
    {
        $this->items = Session::get('cart', []);
    }

    public function render()
    {
        $hasPhysicalProducts = $this->hasPhysicalProducts();
        $total = $this->calculateTotal();

        return view('livewire.shopping-cart', [
            'items' => $this->items,
            'total' => $total,
            'hasPhysicalProducts' => $hasPhysicalProducts,
            'canCheckout' => count($this->items) > 0
        ]);
    }

    public function addToCart($productId, $name, $price, $quantity = 1, $isDownloadable = false, $weight = 0)
    {
        $product = Product::findOrFail($productId);

        // Verify inventory for physical products
        if (!$isDownloadable && $product->inventory_count < $quantity) {
            session()->flash('error', 'Not enough inventory available.');
            return;
        }

        if (isset($this->items[$productId])) {
            $newQuantity = $this->items[$productId]['quantity'] + $quantity;
            if (!$isDownloadable && $newQuantity > $product->inventory_count) {
                session()->flash('error', 'Cannot add more items than available in stock.');
                return;
            }
            $this->items[$productId]['quantity'] = $newQuantity;
        } else {
            $this->items[$productId] = [
                'name' => $name,
                'price' => $price,
                'quantity' => $quantity,
                'is_downloadable' => $isDownloadable,
                'weight' => $weight,
                'product_id' => $productId,
                'image' => $product->image ?? null
            ];
        }

        $this->persistCart();
        session()->flash('success', 'Product added to cart successfully!');
    }

    public function increment($productId)
    {
        if (!isset($this->items[$productId])) return;

        $product = Product::find($productId);
        $isDownloadable = $this->items[$productId]['is_downloadable'];
        
        if (!$isDownloadable && $product && $this->items[$productId]['quantity'] >= $product->inventory_count) {
            session()->flash('error', 'Cannot add more items than available in stock.');
            return;
        }

        $this->items[$productId]['quantity']++;
        $this->persistCart();
    }

    public function decrement($productId)
    {
        if (!isset($this->items[$productId])) return;

        if ($this->items[$productId]['quantity'] <= 1) return;

        $this->items[$productId]['quantity']--;
        $this->persistCart();
    }

    public function updateQuantity($productId, $quantity)
    {
        $quantity = (int)$quantity;
        
        if (!isset($this->items[$productId]) || $quantity < 1) {
            session()->flash('error', 'Invalid quantity');
            return;
        }

        $product = Product::find($productId);
        $isDownloadable = $this->items[$productId]['is_downloadable'];
        
        if (!$isDownloadable && $product && $quantity > $product->inventory_count) {
            session()->flash('error', 'Not enough inventory available.');
            return;
        }

        $this->items[$productId]['quantity'] = $quantity;
        $this->persistCart();
    }

    public function removeItem($productId)
    {
        if (isset($this->items[$productId])) {
            unset($this->items[$productId]);
            $this->persistCart();
            session()->flash('success', 'Product removed from cart');
        }
    }

    public function clearCart()
    {
        $this->items = [];
        Session::forget('cart');
        session()->flash('success', 'Cart cleared successfully');
    }

    protected function persistCart()
    {
        Session::put('cart', $this->items);
        $this->dispatch('cartUpdated'); // Método correcto para Livewire v3
    }

    public function hasPhysicalProducts()
    {
        foreach ($this->items as $item) {
            if (!$item['is_downloadable']) {
                return true;
            }
        }
        return false;
    }

    public function calculateTotal()
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return round($total, 2);
    }
}