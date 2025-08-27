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
                        <h3><span class="orange-text">{{ __('messages.manage') }}</span> {{ __('messages.coupons') }}</h3>
                        <p>{{ __('messages.manage_coupons_desc') }}</p>
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

                    <form action="{{ route('coupons.store') }}" method="POST" class="coupon-form">
                        @csrf
                        <div class="form-group">
                            <label for="code">{{ __('messages.coupon_code') }}</label>
                            <input type="text" id="code" name="code" class="form-control" required
                                   value="{{ old('code') }}" placeholder="{{ __('messages.enter_coupon_code') }}">
                            @error('code')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="type">{{ __('messages.discount_type') }}</label>
                            <select id="type" name="type" class="form-control" required>
                                <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}>{{ __('messages.fixed_amount') }}</option>
                                <option value="percent" {{ old('type') == 'percent' ? 'selected' : '' }}>{{ __('messages.percentage') }}</option>
                            </select>
                            @error('type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="value">{{ __('messages.discount_value') }}</label>
                            <input type="number" id="value" name="value" class="form-control" required step="0.01" min="0"
                                   value="{{ old('value') }}" placeholder="{{ __('messages.enter_discount_value') }}">
                            @error('value')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="min_order_amount">{{ __('messages.min_order_amount') }}</label>
                            <input type="number" id="min_order_amount" name="min_order_amount" class="form-control" required
                                   step="0.01" min="0" value="{{ old('min_order_amount', 0) }}"
                                   placeholder="{{ __('messages.enter_min_order_amount') }}">
                            @error('min_order_amount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="expires_at">{{ __('messages.expiry_date') }}</label>
                            <input type="date" id="expires_at" name="expires_at" class="form-control"
                                   value="{{ old('expires_at') }}" min="{{ date('Y-m-d') }}">
                            @error('expires_at')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary coupon-btn">{{ __('messages.create_coupon') }}</button>
                    </form>

                    <hr class="mt-5 mb-5">

                    <div class="active-coupons mt-4">
                        <h4>{{ __('messages.active_coupons') }}</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>{{ __('messages.code') }}</th>
                                        <th>{{ __('messages.type') }}</th>
                                        <th>{{ __('messages.value') }}</th>
                                        <th>{{ __('messages.min_order') }}</th>
                                        <th>{{ __('messages.expires') }}</th>
                                        <th>{{ __('messages.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($coupons ?? [] as $coupon)
                                        <tr>
                                            <td>{{ $coupon->code }}</td>
                                            <td>{{ ucfirst($coupon->type) }}</td>
                                            <td>{{ $coupon->type === 'percent' ? $coupon->value . '%' : '$' . number_format($coupon->value, 2) }}</td>
                                            <td>${{ number_format($coupon->min_order_amount, 2) }}</td>
                                            <td>{{ $coupon->expires_at ? $coupon->expires_at->format('Y-m-d') : __('messages.never') }}</td>
                                            <td>
                                                <a href="{{ route('coupons.edit', $coupon) }}" class="btn btn-warning btn-sm">{{ __('messages.edit') }}</a>
                                                <form action="{{ route('coupons.destroy', $coupon) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('{{ __('messages.confirm_delete_coupon') }}')">
                                                        {{ __('messages.delete') }}
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
