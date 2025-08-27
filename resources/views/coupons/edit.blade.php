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
                    <h3><span class="orange-text">{{ __('messages.edit') }}</span> {{ __('messages.coupon') }}</h3>
                    <p>{{ __('messages.edit_coupon_desc') }}</p>
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
                        <label for="code">{{ __('messages.coupon_code') }}</label>
                        <input type="text" id="code" name="code" class="form-control" required
                               value="{{ old('code', $coupon->code) }}" placeholder="{{ __('messages.coupon_code_placeholder') }}">
                        @error('code')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="type">{{ __('messages.discount_type') }}</label>
                        <select id="type" name="type" class="form-control" required>
                            <option value="fixed" {{ old('type', $coupon->type) == 'fixed' ? 'selected' : '' }}>{{ __('messages.fixed_amount') }}</option>
                            <option value="percent" {{ old('type', $coupon->type) == 'percent' ? 'selected' : '' }}>{{ __('messages.percentage') }}</option>
                        </select>
                        @error('type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="value">{{ __('messages.discount_value') }}</label>
                        <input type="number" id="value" name="value" class="form-control" required step="0.01" min="0"
                               value="{{ old('value', $coupon->value) }}" placeholder="{{ __('messages.discount_value_placeholder') }}">
                        @error('value')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="min_order_amount">{{ __('messages.min_order_amount') }}</label>
                        <input type="number" id="min_order_amount" name="min_order_amount" class="form-control" required
                               step="0.01" min="0" value="{{ old('min_order_amount', $coupon->min_order_amount) }}"
                               placeholder="{{ __('messages.min_order_amount_placeholder') }}">
                        @error('min_order_amount')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="expires_at">{{ __('messages.expiry_date') }}</label>
                        <input type="date" id="expires_at" name="expires_at" class="form-control"
                               value="{{ old('expires_at', $coupon->expires_at ? $coupon->expires_at->format('Y-m-d') : '') }}" min="{{ date('Y-m-d') }}">
                        @error('expires_at')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary coupon-btn">{{ __('messages.update_coupon') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
