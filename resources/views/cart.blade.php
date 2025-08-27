@extends('layouts.app')

@section('content')
<style>
    .update-btn {
        background-color: #F28123;
        border: none;
        color: white;
        border-radius: 50px;
    }
    .update-btn:hover {
        background-color: #051922;
        color: #F28123;
    }
</style>
<!-- cart -->
<div class="cart-section mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="cart-table-wrap">
                    <table class="cart-table">
                        <thead class="cart-table-head">
                            <tr class="table-head-row">
                                <th class="product-remove"></th>
                                <th class="product-image">{{ __('messages.product_image') }}</th>
                                <th class="product-name">{{ __('messages.name') }}</th>
                                <th class="product-price">{{ __('messages.price') }}</th>
                                <th class="product-quantity">{{ __('messages.quantity') }}</th>
                                <th class="product-total">{{ __('messages.total') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($cartItems->count() > 0)
                                @foreach($cartItems as $item)
                                    <tr class="table-body-row">
                                        <td class="product-remove">
                                            <form action="{{ route('cart.destroy', $item) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="far fa-window-close"></i></button>
                                            </form>
                                        </td>

                                        <td class="product-image"><img src="{{ asset('uploads/' . $item->product->image) }}" alt=""></td>
                                        <td class="product-name">
                                            <a href="{{ route('products.show', $item->product) }}">{{ $item->product->name }}</a>
                                        </td>
                                        <td class="product-price">${{ number_format($item->unit_price, 2) }}</td>
                                        <td class="product-quantity">
                                            <form action="{{ route('cart.update', $item) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1">
                                                <button type="submit" class="btn btn-primary btn-sm update-btn">{{ __('messages.update') }}</button>
                                            </form>
                                        </td>
                                        <td class="product-total">${{ number_format($item->subtotal, 2) }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center">{{ __('messages.empty_cart') }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="total-section">
                    <table class="total-table">
                        <thead class="total-table-head">
                            <tr class="table-total-row">
                                <th>{{ __('messages.total') }}</th>
                                <th>{{ __('messages.price') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="total-data">
                                <td><strong>{{ __('messages.subtotal') }}: </strong></td>
                                <td>${{ number_format($cart->total, 2) }}</td>
                            </tr>
                            @if($cart->coupon)
                                <tr class="total-data">
                                    <td><strong>{{ __('messages.discount') }}: </strong></td>
                                    <td>${{ number_format($discount, 2) }}</td>
                                </tr>
                            @endif
                            <tr class="total-data">
                                <td><strong>{{ __('messages.shipping_cost') }}: </strong></td>
                                <td>${{ number_format($shipping, 2) }}</td>
                            </tr>
                            <tr class="total-data">
                                <td><strong>{{ __('messages.grand_total') }}: </strong></td>
                                <td>${{ number_format($totalAfterDiscount + $shipping, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                    @if($cart->coupon)
                        <div class="cart-buttons">
                            <a href="{{ route('coupon.remove') }}" class="boxed-btn">{{ __('messages.remove_coupon') }}</a>
                        </div>
                    @endif
                    <div class="cart-buttons">
                        <a href="{{ route('checkout.show') }}" class="boxed-btn black">{{ __('messages.checkout') }}</a>
                    </div>
                </div>

                <div class="coupon-section">
                    <h3>{{ __('messages.apply_coupon') }}</h3>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="coupon-form-wrap">
                        <form action="{{ route('coupon.apply') }}" method="POST">
                            @csrf
                            <p><input type="text" name="code" placeholder="{{ __('messages.coupon_placeholder') }}"></p>
                            <p><input type="submit" value="{{ __('messages.apply') }}"></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end cart -->

@endsection
