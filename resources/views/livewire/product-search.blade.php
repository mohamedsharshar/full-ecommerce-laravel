<div class="w-full max-w-lg mx-auto d-flex justify-content-center align-items-center">
    <input
        type="text"
        wire:model.debounce.500ms="query"
        wire:keydown.enter="performSearch"
        class="w-full border rounded-lg p-2"
        placeholder="ابحث عن منتج أو تصنيف..."
    >

    @if(!empty($results))
        <div class="bg-white shadow mt-2 rounded-lg">
            @foreach($results as $product)
                <div class="p-2 border-b">
                    <strong>{{ $product->name }}</strong>
                    <span class="text-gray-500">({{ $product->category->name }})</span>
                </div>
            @endforeach
        </div>
    @endif
</div>
