@extends('layouts.app')

@section('content')
 <style>
        .admin-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .admin-buttons .btn {
            padding: 5px 15px;
            font-size: 14px;
        }

        .admin-buttons .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #000;
        }

        .admin-buttons .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
            color: #fff;
        }
    </style>
    {{-- Category section --}}
    <div class="category-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">{{ __('messages.site_categories') }}</span></h3>
                        <p>{{ __('messages.discover_categories') }}</p>
                    </div>
                </div>
            </div>
            <div style="display: flex; flex-wrap: wrap; gap: 30px; justify-content: center;">
                @foreach ($mainCategories as $mainCategory)
                    <div class="col-lg-4 col-md-6 text-center" style="flex: 0 1 340px; max-width: 370px;">
                        <div class="single-product-item p-3" style="border:1px solid #eee; border-radius:12px; background:#fff; box-shadow:0 2px 8px #eee;">
                            <div class="product-image mb-2">
                                <a href="/products/{{ $mainCategory->id }}">
                                    <img src="{{ url($mainCategory->image) }}" alt="" style="max-width: 100%; max-height: 160px; border-radius:8px;">
                                </a>
                            </div>
                            <h3 class="mb-1">{{ $mainCategory->name }}</h3>
                            <p class="mb-2 text-muted" style="min-height:40px;">{{ $mainCategory->description }}</p>
                            @php
                                $subs = $subCategories->where('parent_id', $mainCategory->id);
                            @endphp
                            @if($subs->count())
                                <div class="subcategories-list text-start mt-2">
                                    <strong style="font-size:15px;">{{ __('messages.sub_category') }}:</strong>
                                    <ul style="list-style: disc inside; padding-left: 10px;">
                                        @foreach($subs as $sub)
                                            <li style="font-size:15px; margin-bottom:2px;">
                                                <a href="/products/{{ $sub->id }}" style="color:#ff6600; text-decoration:underline;">{{ $sub->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    {{-- end Category section --}}

    <!-- product section -->
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">{{ __('messages.our') }}</span> {{ __('messages.our_products') }}</h3>
                        <p>{{ __('messages.our_products_desc') }}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="product-filters">
                        <ul>
                            @foreach ($mainCategories as $mainCategory)
                                <li data-filter=".cat-{{ $mainCategory->id }}">{{ $mainCategory->name }}</li>
                                @foreach ($subCategories->where('parent_id', $mainCategory->id) as $subCategory)
                                    <li data-filter=".cat-{{ $subCategory->id }}">&nbsp;&nbsp;{{ $subCategory->name }}
                                    </li>
                                @endforeach
                            @endforeach
                            <li class="active" data-filter="*">{{ __('messages.all') }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row product-lists">
                @forelse ($products as $product)
                    <div
                        class="col-lg-4 col-md-6 text-center cat-{{ $product->category_id ?? 'uncategorized' }} @if ($product->subcategory_id) cat-{{ $product->subcategory_id }} @endif">
                        <div class="single-product-item">
                            <div class="product-image">
                                <a href="{{ route('products.show', $product) }}">
                                    <img src="{{ asset('uploads/' . $product->image) }}"
                                        style="max-height: 200px; min-height: 200px;" alt="">
                                </a>
                            </div>
                            <h3>{{ $product->name }}</h3>
                            <p class="product-desc">
                                {{ \Illuminate\Support\Str::words($product->description, 5, '...') }}
                            </p>

                            <p class="product-price"><span>{{ __('messages.price') }}</span> {{ $product->price }}$ </p>
                            <form action="{{ route('cart.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="cart-btn">
                                    <i class="fas fa-shopping-cart"></i> {{ __('messages.add_to_cart') }}
                                </button>
                            </form>

                            @role('admin')
                                <div class="admin-buttons mt-3">
                                    <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> {{ __('messages.edit') }}
                                    </a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST"
                                        class="d-inline-block" onsubmit="return confirm('{{ __('messages.confirm_delete') }});">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> {{ __('messages.delete') }}
                                        </button>
                                    </form>
                                </div>
                            @endrole
                        </div>
                    </div>
                @empty
                    <div class="col-lg-12 text-center">
                        <p>{{ __('messages.no_products_found') }}</p>
                    </div>
                @endforelse
            </div>

            <div class="row">
                <div class="col-lg-12 text-center">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- end product section -->
@endsection
