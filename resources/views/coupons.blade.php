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
                        <h3><span class="orange-text">Manage</span> Coupons</h3>
                        <p>Create and manage discount coupons for your store</p>
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
                            <label for="code">Coupon Code</label>
                            <input type="text" id="code" name="code" class="form-control" required
                                   value="{{ old('code') }}" placeholder="Enter coupon code (e.g., SUMMER2025)">
                            @error('code')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="type">Discount Type</label>
                            <select id="type" name="type" class="form-control" required>
                                <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}>Fixed Amount</option>
                                <option value="percent" {{ old('type') == 'percent' ? 'selected' : '' }}>Percentage</option>
                            </select>
                            @error('type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="value">Discount Value</label>
                            <input type="number" id="value" name="value" class="form-control" required step="0.01" min="0"
                                   value="{{ old('value') }}" placeholder="Enter discount value">
                            @error('value')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="min_order_amount">Minimum Order Amount</label>
                            <input type="number" id="min_order_amount" name="min_order_amount" class="form-control" required
                                   step="0.01" min="0" value="{{ old('min_order_amount', 0) }}"
                                   placeholder="Minimum order amount required">
                            @error('min_order_amount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="expires_at">Expiry Date</label>
                            <input type="date" id="expires_at" name="expires_at" class="form-control"
                                   value="{{ old('expires_at') }}" min="{{ date('Y-m-d') }}">
                            @error('expires_at')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary coupon-btn">Create Coupon</button>
                    </form>

                    <hr class="mt-5 mb-5">

                    <div class="active-coupons mt-4">
                        <h4>Active Coupons</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Type</th>
                                        <th>Value</th>
                                        <th>Min Order</th>
                                        <th>Expires</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($coupons ?? [] as $coupon)
                                        <tr>
                                            <td>{{ $coupon->code }}</td>
                                            <td>{{ ucfirst($coupon->type) }}</td>
                                            <td>{{ $coupon->type === 'percent' ? $coupon->value . '%' : '$' . number_format($coupon->value, 2) }}</td>
                                            <td>${{ number_format($coupon->min_order_amount, 2) }}</td>
                                            <td>{{ $coupon->expires_at ? $coupon->expires_at->format('Y-m-d') : 'Never' }}</td>
                                            <td>
                                                <a href="{{ route('coupons.edit', $coupon) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('coupons.destroy', $coupon) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Are you sure you want to delete this coupon?')">
                                                        Delete
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
