@extends('layouts.app')

@section('content')
    {{-- Category section --}}
    <div class="category-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">اصناف</span> الموقع</h3>
                        <p>اكتشف العديد من الاصناف</p>
                    </div>
                </div>
            </div>
            <div style="display: flex; flex-wrap: wrap; gap: 30px; justify-content: center;">
                @foreach ($mainCategories as $mainCategory)
                    <div class="col-lg-4 col-md-6 text-center" style="flex: 0 1 300px; max-width: 350px;">
                        <div class="single-product-item">
                            <div class="product-image">
                                <a href="/products/{{ $mainCategory->id }}"><img src="{{ url($mainCategory->image) }}"
                                        alt=""></a>
                            </div>
                            <h3>{{ $mainCategory->name }}</h3>
                            <p>{{ $mainCategory->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    {{-- end Category section -- --}}
    <!-- product section -->
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">اقسام</span> الموقع</h3>
                        <p>متعة التسوق عبر فروعنا</p>
                    </div>
                </div>
            </div>

            <div style="display: flex; flex-wrap: wrap; gap: 30px; justify-content: center;">
                @foreach ($categories as $category)
                    <div class="col-lg-4 col-md-6 text-center" style="flex: 0 1 300px; max-width: 350px;">
                        <div class="single-product-item">
                            <div class="product-image">
                                <a href="/products/{{ $category->id }}"><img src="{{ url($category->image) }}"
                                        alt=""></a>
                            </div>
                            <h3>{{ $category->name }}</h3>
                            <p>{{ $category->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- end product section -->
@endsection
