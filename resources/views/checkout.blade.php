@extends('layouts.app')

@section('content')
<!-- check out section -->
<div class="checkout-section mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="checkout-accordion-wrap">
                    <div class="accordion" id="accordionExample">
                        <div class="card single-accordion">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        معلومات الشحن
                                    </button>
                                </h5>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    <x-shipping-form :shipping="$shippingInfo ?? null" />
                                </div>
                            </div>
                        </div>

                        <div class="card single-accordion">
                            <div class="card-header" id="headingTwo">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        طريقة الدفع
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="payment-method">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="payment_method" id="cash_on_delivery" value="cash_on_delivery" checked>
                                            <label class="form-check-label" for="cash_on_delivery">
                                                الدفع عند الاستلام
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="order-details-wrap">
                    <table class="order-details">
                        <thead>
                            <tr>
                                <th>تفاصيل الطلب</th>
                                <th>السعر</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartItems as $item)
                            <tr>
                                <td>{{ $item->product->name }} × {{ $item->quantity }}</td>
                                <td>${{ number_format($item->product->price * $item->quantity, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td><strong>المجموع الفرعي</strong></td>
                                <td>${{ number_format($total, 2) }}</td>
                            </tr>
                            @if($discount > 0)
                            <tr>
                                <td><strong>الخصم</strong></td>
                                <td>-${{ number_format($discount, 2) }}</td>
                            </tr>
                            @endif
                            <tr>
                                <td><strong>تكلفة الشحن</strong></td>
                                <td>${{ number_format($shipping, 2) }}</td>
                            </tr>
                            <tr>
                                <td><strong>الإجمالي</strong></td>
                                <td>${{ number_format($totalAfterDiscount + $shipping, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                    <form action="{{ route('checkout.process') }}" method="POST" class="mt-4">
                        @csrf
                        <button type="submit" class="boxed-btn">إتمام الطلب</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end check out section -->
@endsection
