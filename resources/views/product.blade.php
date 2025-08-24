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
                            <li class="active" data-filter="*">الكل</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row product-lists">
                @forelse ($products as $product)
                    <div class="col-lg-4 col-md-6 text-center cat-{{ $product->category_id ?? 'uncategorized' }}">
                        <div class="single-product-item">
                            <div class="product-image">
                                <a href="{{ route('products.show', $product) }}">
                                    <img src="{{ asset('uploads/' . $product->image) }}" style="max-height: 200px; min-height: 200px;"
                                        alt="">
                                </a>
                            </div>
                            <h3>{{ $product->name }}</h3>
                            <p class="product-desc">
                                {{ \Illuminate\Support\Str::words($product->description, 5, '...') }}
                            </p>

                            <p class="product-price"><span>السعر</span> {{ $product->price }}$ </p>
                            <form action="{{ route('cart.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="cart-btn"><i class="fas fa-shopping-cart"></i> أضف للسلة</button>
                            </form>

                            @role('admin')
                            <div class="admin-buttons mt-3">
                                <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> تعديل
                                </a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline-block" onsubmit="return confirm('هل أنت متأكد من حذف هذا المنتج؟');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> حذف
                                    </button>
                                </form>
                            </div>
                            @endrole
                        </div>
                    </div>
                @empty
                    <div class="col-lg-12 text-center">
                        <p>No products found matching your search.</p>
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
