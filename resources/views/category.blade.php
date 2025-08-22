@extends('layouts.app')

@section('content')
    <style>
        .single-product-item {
            min-height: 420px;
            max-height: 420px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            box-sizing: border-box;
        }

        .single-product-item h3 {
            font-size: 1.15rem;
            font-weight: bold;
            margin-bottom: 8px;
            color: #ff7f32;
        }

        .single-product-item p {
            font-size: 1rem;
            color: #444;
            margin-bottom: 8px;
        }

        .single-product-item .product-desc {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            width: 100%;
            display: block;
        }
    </style>
    <!-- categories -->
    <div class="category-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                @foreach ($mainCategories as $mainCategory)
                    <div class="col-md-4">
                        <div class="single-category-item">
                            <h3>{{ $mainCategory->name }}</h3>
                            <p><strong>الوصف:</strong> {{ $mainCategory->description }}</p>
                            @if($mainCategory->image)
                                <div style="margin-bottom:10px;">
                                    <img src="{{ asset('uploads/' . $mainCategory->image) }}" alt="{{ $mainCategory->name }}" style="max-width:100%;max-height:150px;">
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- products -->
    <div class="product-section mt-150 mb-150">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <div class="product-filters">
                        <ul>
                            @foreach ($mainCategories as $mainCategory)
                                <li data-filter=".cat-{{ $mainCategory->id }}">{{ $mainCategory->name }}</li>
                                @foreach ($subCategories->where('parent_id', $mainCategory->id) as $subCategory)
                                    <li data-filter=".cat-{{ $subCategory->id }}">&nbsp;&nbsp;{{ $subCategory->name }}</li>
                                @endforeach
                            @endforeach
                            <li class="active" data-filter="*">الكل</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row product-lists">
                @foreach ($products as $product)
                    <div class="col-lg-4 col-md-6 text-center cat-{{ $product->category_id ?? 'uncategorized' }} @if($product->subcategory_id) cat-{{ $product->subcategory_id }} @endif">
                        <div class="single-product-item">
                            <div class="product-image">
                                <a href="/categories/{{ $product->category_id }}/products">
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
                @endforeach
            </div>


        </div>

        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="pagination-wrap">
                    <ul>
                        <li><a href="#">Prev</a></li>
                        <li><a href="#">1</a></li>
                        <li><a class="active" href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">Next</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- end products -->
@endsection
