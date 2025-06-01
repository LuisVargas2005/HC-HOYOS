<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
{
    $products = auth()->user()->wishlist()->with('category')->get();
    return view('wishlist.index', ['products' => $products]);
}
    public function add(Product $product)
    {
        // Verificar si ya está en la wishlist
        if (!Auth::user()->wishlist()->where('product_id', $product->id)->exists()) {
            Auth::user()->wishlist()->attach($product->id, [
                'share_token' => Str::random(32)
            ]);
            return redirect()->back()->with('success', 'Product added to wishlist');
        }
        
        return redirect()->back()->with('info', 'Product already in wishlist');
    }

    public function remove(Product $product)
    {
        Auth::user()->wishlist()->detach($product->id);
        return redirect()->back()->with('success', 'Product removed from wishlist');
    }

    public function share()
    {
        $user = Auth::user();
        $shareToken = Str::random(32);
        
        // Actualizar todos los items con el mismo token
        $user->wishlist()->update([
            'share_token' => $shareToken
        ]);
        
        return redirect()->route('wishlist.index')
               ->with('share_url', route('wishlist.shared', $shareToken));
    }

    public function sharedWishlist($shareToken)
    {
        $products = Product::whereHas('wishlistedBy', function($query) use ($shareToken) {
            $query->where('share_token', $shareToken);
        })->with(['category', 'images'])->get();
        
        return view('wishlist.shared', compact('products'));
    }
}
