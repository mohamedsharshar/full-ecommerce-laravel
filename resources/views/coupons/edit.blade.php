@extends('layouts.app')

@section('content')
<style>
    .coupon-btn{
        background: #F28123;
        color: white;
        border: none;
        border-radius: 50px;
        padding: 10px 20px;
    }
    .coupon-btn:hover{
        background: #051922;
        color: #F28123;
    }
</style>
<div class="cart-section mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="section-title">
                    <h3><span class="orange-text">Edit</span> Coupon</h3>
                    <p>Edit the coupon details below</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 offset-lg-2">
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

                <form action="{{ route('coupons.update', $coupon) }}" method="POST" class="coupon-form">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="code">Coupon Code</label>
                        <input type="text" id="code" name="code" class="form-control" required
                               value="{{ old('code', $coupon->code) }}" placeholder="Enter coupon code (e.g., SUMMER2025)">
                        @error('code')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="type">Discount Type</label>
                        <select id="type" name="type" class="form-control" required>
                            <option value="fixed" {{ old('type', $coupon->type) == 'fixed' ? 'selected' : '' }}>Fixed Amount</option>
                            <option value="percent" {{ old('type', $coupon->type) == 'percent' ? 'selected' : '' }}>Percentage</option>
                        </select>
                        @error('type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="value">Discount Value</label>
                        <input type="number" id="value" name="value" class="form-control" required step="0.01" min="0"
                               value="{{ old('value', $coupon->value) }}" placeholder="Enter discount value">
                        @error('value')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="min_order_amount">Minimum Order Amount</label>
                        <input type="number" id="min_order_amount" name="min_order_amount" class="form-control" required
                               step="0.01" min="0" value="{{ old('min_order_amount', $coupon->min_order_amount) }}"
                               placeholder="Minimum order amount required">
                        @error('min_order_amount')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="expires_at">Expiry Date</label>
                        <input type="date" id="expires_at" name="expires_at" class="form-control"
                               value="{{ old('expires_at', $coupon->expires_at ? $coupon->expires_at->format('Y-m-d') : '') }}" min="{{ date('Y-m-d') }}">
                        @error('expires_at')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary coupon-btn">Update Coupon</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection