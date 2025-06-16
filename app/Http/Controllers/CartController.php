<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function add(Request $request, Product $product)
    {
        $quantity = $request->input('quantity', 1);
        
        if ($product->inventory_count < $quantity) {
            return redirect()->back()->with('error', 'No hay suficiente inventario disponible.');
        }

        $cart = Session::get('cart', []);
        
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'is_downloadable' => $product->is_downloadable,
            ];
        }

        Session::put('cart', $cart);
        
        return redirect()->back()->with('success', '¡Producto añadido al carrito exitosamente!');
    }

    public function index()
    {
        return view('cart.index');
    }
}