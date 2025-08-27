@extends('layouts.app')

@section('styles')
<style>
    @media print {
        .no-print { display: none !important; }
        .print-only { display: block !important; }
        .card { border: none !important; box-shadow: none !important; }
        .card-header { background-color: #fff !important; color: #000 !important; border-bottom: 2px solid #000; }
        .container { max-width: 100% !important; width: 100% !important; padding: 0 !important; margin: 0 !important; }
        .table { width: 100% !important; }
        .table td, .table th { padding: 0.5rem !important; }
        body { font-size: 14px !important; }
        .print-footer { position: fixed; bottom: 0; width: 100%; text-align: center; padding: 10px; border-top: 1px solid #ddd; }
    }
    .print-only { display: none; }
</style>
@endsection

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-success text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">{{ __('messages.order_details') }} #{{ $order->id }}</h3>
                        <a href="{{ route('orders.invoice', $order->id) }}" target="_blank" class="btn btn-light">
                            <i class="fas fa-print"></i> {{ __('messages.view_invoice') }}
                        </a>
                    </div>
                </div>
                <div class="print-only text-center py-3">
                    <h2>{{ __('messages.invoice') }}</h2>
                    <p>{{ __('messages.print_date') }}: {{ now()->format('Y-m-d H:i') }}</p>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <h4>{{ __('messages.order_info') }}</h4>
                            <table class="table">
                                <tr>
                                    <th>{{ __('messages.order_number') }}:</th>
                                    <td>#{{ $order->id }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('messages.order_status') }}:</th>
                                    <td>{{ $order->status }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('messages.subtotal') }}:</th>
                                    <td>${{ number_format($order->subtotal, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('messages.discount') }}:</th>
                                    <td>${{ number_format($order->discount, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('messages.grand_total') }}:</th>
                                    <td>${{ number_format($order->total, 2) }}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-6">
                            <h4>{{ __('messages.ship_info') }}</h4>
                            <table class="table">
                                <tr>
                                    <th>{{ __('messages.name') }}:</th>
                                    <td>{{ $order->shipping->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('messages.email') }}:</th>
                                    <td>{{ $order->shipping->email }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('messages.address') }}:</th>
                                    <td>{{ $order->shipping->address }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('messages.city') }}:</th>
                                    <td>{{ $order->shipping->city }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('messages.state') }}:</th>
                                    <td>{{ $order->shipping->state }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('messages.zip') }}:</th>
                                    <td>{{ $order->shipping->zip }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h4>{{ __('messages.ordered_products') }}</h4>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ __('messages.product') }}</th>
                                        <th>{{ __('messages.price') }}</th>
                                        <th>{{ __('messages.quantity') }}</th>
                                        <th>{{ __('messages.total') }}</th>
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
                        <a href="{{ route('orders.index') }}" class="btn btn-secondary">{{ __('messages.back_to_orders') }}</a>
                    </div>

                    <div class="print-only print-footer">
                        <p class="mb-0">{{ __('messages.thank_you') }}</p>
                        <p class="mb-0">{{ config('app.name') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
