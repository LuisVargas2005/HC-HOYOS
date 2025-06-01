<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class WishlistToggle extends Component
{
    public Product $product;
    public bool $isInWishlist = false;

    public function mount(Product $product): void
    {
        $this->product = $product;
        $this->isInWishlist = Auth::check() && 
                              Auth::user()->wishlist->contains($product->id);
    }

    public function toggle(): mixed
    {
        if (!Auth::check()) {
            // En Livewire 3, usar redirect()->to(...) dentro de un método debe retornar
            return redirect()->to(route('login'));
        }

        $user = Auth::user();

        if ($this->isInWishlist) {
            $user->wishlist()->detach($this->product->id);
        } else {
            $user->wishlist()->attach($this->product->id);
        }

        $this->isInWishlist = !$this->isInWishlist;
        $this->dispatch('wishlistUpdated');

        return null;
    }

    public function render()
    {
        return view('livewire.wishlist-toggle');
    }
}