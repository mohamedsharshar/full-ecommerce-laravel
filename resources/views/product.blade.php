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

            <style>
                .modern-products-flex {
                    display: flex;
                    flex-wrap: wrap;
                    gap: 32px;
                    justify-content: center;
                }

                .modern-product-card {
                    background: #fff;
                    border-radius: 18px;
                    box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
                    padding: 24px 18px 18px 18px;
                    flex: 0 1 320px;
                    max-width: 350px;
                    margin-bottom: 10px;
                    transition: box-shadow 0.2s;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                }

                .modern-product-card:hover {
                    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.16);
                }

                .modern-product-card .product-image img {
                    max-width: 180px;
                    max-height: 180px;
                    border-radius: 12px;
                    margin-bottom: 16px;
                    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
                }

                .modern-product-card h3 {
                    font-size: 1.3rem;
                    font-weight: bold;
                    margin-bottom: 8px;
                    color: #ff7f32;
                }

                .modern-product-card .desc {
                    color: #666;
                    font-size: 1rem;
                    margin-bottom: 10px;
                    min-height: 40px;
                }

                .modern-product-card .price {
                    font-size: 1.1rem;
                    color: #1a9c4b;
                    font-weight: bold;
                    margin-bottom: 6px;
                }

                .modern-product-card .qty {
                    font-size: 0.98rem;
                    color: #888;
                    margin-bottom: 12px;
                }

                .modern-product-card .cart-btn {
                    background: linear-gradient(90deg, #ff7f32 0%, #ffb347 100%);
                    color: #fff;
                    border: none;
                    border-radius: 8px;
                    padding: 8px 22px;
                    font-size: 1rem;
                    font-weight: 600;
                    transition: background 0.2s;
                    box-shadow: 0 2px 8px rgba(255, 127, 50, 0.08);
                }

                .modern-product-card .cart-btn:hover {
                    background: linear-gradient(90deg, #ffb347 0%, #ff7f32 100%);
                    color: #fff;
                }
            </style>
            <div class="modern-products-flex">
                @forelse ($products as $product)
                    <div class="modern-product-card">
                        <div class="product-image">
                            <a href="/products">
                                <img src="{{ asset('uploads/' . $product->image) }}" alt="" width="100px"
                                    height="100px">
                            </a>
                        </div>
                        <h3>{{ $product->name }}</h3>
                        <div class="desc">{{ Str::limit($product->description, 100, '...') }}</div>
                        <div class="price">${{ $product->price }}</div>
                        <div class="qty">الكمية: {{ $product->quantity }}</div>
                        <a href="/cart" class="cart-btn"><i class="fas fa-shopping-cart"></i> أضف للسلة</a>
                        <div class="process">
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger mt-4"><i class="fas fa-trash"></i> حذف
                                    منتج</button>
                            </form>
                            <form action="{{ route('products.edit', $product->id) }}" method="GET"
                                style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-warning mt-4"><i class="fas fa-edit"></i> تعديل
                                    منتج</button>
                            </form>
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
