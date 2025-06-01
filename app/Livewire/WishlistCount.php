<?php

namespace App\Livewire;  // Si guardaste en app/Livewire

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class WishlistCount extends Component
{
    protected $listeners = ['wishlistUpdated' => '$refresh'];
    
    public function render()
    {
        $count = Auth::check() ? Auth::user()->wishlist()->count() : 0;
        return view('livewire.wishlist-count', compact('count'));
    }
}