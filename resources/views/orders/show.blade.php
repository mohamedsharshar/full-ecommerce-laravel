@extends('layouts.app')

@section('styles')
<style>
    @media print {
        .no-print {
            display: none !important;
        }
        .print-only {
            display: block !important;
        }
        .card {
            border: none !important;
            box-shadow: none !important;
        }
        .card-header {
            background-color: #fff !important;
            color: #000 !important;
            border-bottom: 2px solid #000;
        }
        .container {
            max-width: 100% !important;
            width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        .table {
            width: 100% !important;
        }
        .table td, .table th {
            padding: 0.5rem !important;
        }
        body {
            font-size: 14px !important;
        }
        .print-footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            padding: 10px;
            border-top: 1px solid #ddd;
        }
    }
    .print-only {
        display: none;
    }
</style>
@endsection

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-success text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">تفاصيل الطلب #{{ $order->id }}</h3>
                        <a href="{{ route('orders.invoice', $order->id) }}" target="_blank" class="btn btn-light">
                            <i class="fas fa-print"></i> عرض وطباعة الفاتورة
                        </a>
                    </div>
                </div>
                <div class="print-only text-center py-3">
                    <h2>فاتورة</h2>
                    <p>تاريخ الطباعة: {{ now()->format('Y-m-d H:i') }}</p>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <h4>معلومات الطلب</h4>
                            <table class="table">
                                <tr>
                                    <th>رقم الطلب:</th>
                                    <td>#{{ $order->id }}</td>
                                </tr>
                                <tr>
                                    <th>حالة الطلب:</th>
                                    <td>{{ $order->status }}</td>
                                </tr>
                                <tr>
                                    <th>المجموع الفرعي:</th>
                                    <td>${{ number_format($order->subtotal, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>الخصم:</th>
                                    <td>${{ number_format($order->discount, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>الإجمالي:</th>
                                    <td>${{ number_format($order->total, 2) }}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-6">
                            <h4>معلومات الشحن</h4>
                            <table class="table">
                                <tr>
                                    <th>الاسم:</th>
                                    <td>{{ $order->shipping->name }}</td>
                                </tr>
                                <tr>
                                    <th>البريد الإلكتروني:</th>
                                    <td>{{ $order->shipping->email }}</td>
                                </tr>
                                <tr>
                                    <th>العنوان:</th>
                                    <td>{{ $order->shipping->address }}</td>
                                </tr>
                                <tr>
                                    <th>المدينة:</th>
                                    <td>{{ $order->shipping->city }}</td>
                                </tr>
                                <tr>
                                    <th>المنطقة:</th>
                                    <td>{{ $order->shipping->state }}</td>
                                </tr>
                                <tr>
                                    <th>الرمز البريدي:</th>
                                    <td>{{ $order->shipping->zip }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h4>المنتجات المطلوبة</h4>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>المنتج</th>
                                        <th>السعر</th>
                                        <th>الكمية</th>
                                        <th>المجموع</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->items as $item)
                                        <tr>
                                            <td>{{ $item->product->name }}</td>
                                            <td>${{ number_format($item->price, 2) }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-4 text-center no-print">
                        <a href="{{ route('orders.index') }}" class="btn btn-secondary">العودة إلى قائمة الطلبات</a>
                    </div>

                    <div class="print-only print-footer">
                        <p class="mb-0">شكراً لتسوقكم معنا!</p>
                        <p class="mb-0">{{ config('app.name') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
