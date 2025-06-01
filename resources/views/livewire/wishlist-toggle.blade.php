{{-- resources/views/livewire/wishlist-toggle.blade.php --}}
<div>
    <button wire:click="toggle" class="px-4 py-2 text-white rounded 
        {{ $isInWishlist ? 'bg-red-600 hover:bg-red-700' : 'bg-blue-600 hover:bg-blue-700' }}">
        {{ $isInWishlist ? 'Remove from Wishlist' : 'Add to Wishlist' }}
    </button>
</div>