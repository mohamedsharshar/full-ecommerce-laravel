@extends('layouts.app')

@section('content')
    <!-- product section -->
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">Our</span> Products</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet
                            beatae optio.</p>
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
                    <div class="col-lg-4 col-md-6 text-center cat-{{ $product->category_id ?? 'uncategorized' }} @if($product->subcategory_id) cat-{{ $product->subcategory_id }} @endif">
                        <div class="single-product-item">
                            <div class="product-image">
                                <a href="/products">
                                    <img src="{{ asset('uploads/' . $product->image) }}" style="max-height: 200px; min-height: 200px;"
                                        alt="">
                                </a>
                            </div>
                            <h3>{{ $product->name }}</h3>
                            <p class="product-desc">
                                {{ \Illuminate\Support\Str::words($product->description, 5, '...') }}
                            </p>

                            <p class="product-price"><span>السعر</span> {{ $product->price }}$ </p>
                            <a href="cart.html" class="cart-btn"><i class="fas fa-shopping-cart"></i> أضف للسلة</a>
                        </div>
                    </div>
                @empty
                    <div class="col-lg-12 text-center">
                        <p>No products found matching your search.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <!-- end product section -->
@endsection
