<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.invoice') }} #{{ $order->id }}</title>
    <style>
        @page {
            size: A4;
            margin: 10mm;
        }
        body {
            font-family: Arial, sans-serif;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 15px;
            font-size: 12px;
        }
        h1 { font-size: 24px; margin: 0 0 10px 0; }
        h3 { font-size: 16px; margin: 10px 0; }
        h4 { font-size: 14px; margin: 5px 0; }
        p { margin: 3px 0; }
        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #000;
        }
        .invoice-body { margin-bottom: 20px; }
        .row { display: flex; margin-bottom: 15px; }
        .col { flex: 1; padding: 8px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        th, td {
            padding: 8px;
            text-align: right;
            border-bottom: 1px solid #ddd;
            font-size: 12px;
        }
        th { background-color: #f8f9fa; }
        .total-section {
            margin-top: 15px;
            border-top: 2px solid #000;
            padding-top: 10px;
        }
        .invoice-footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
            position: fixed;
            bottom: 5mm;
            left: 0;
            right: 0;
        }
        .info-box {
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .info-box h4 {
            margin-top: 0;
            margin-bottom: 8px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 3px;
        }
        @media print {
            body { padding: 0; margin: 0; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            .invoice-header { margin-bottom: 15px; }
        }
    </style>
</head>
<body>
    <button onclick="window.print()" class="print-button btn btn-primary" style="position: fixed; top: 20px; left: 20px; padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">
        {{ __('messages.print_invoice') }}
    </button>
    <div class="invoice-header">
        <h1>{{ __('messages.invoice') }}</h1>
        <p style="margin: 5px 0;">{{ __('messages.order_number') }}: #{{ $order->id }}</p>
        <p style="margin: 5px 0;">{{ __('messages.order_date') }}: {{ $order->created_at->format('Y-m-d') }}</p>
    </div>

    <div class="invoice-body">
        <div class="row">
            <div class="col info-box">
                <h4>{{ __('messages.customer_info') }}</h4>
                <p><strong>{{ __('messages.name') }}:</strong> {{ $order->shipping->name }}</p>
                <p><strong>{{ __('messages.email') }}:</strong> {{ $order->shipping->email }}</p>
                <p><strong>{{ __('messages.address') }}:</strong> {{ $order->shipping->address }}</p>
                <p><strong>{{ __('messages.city') }}:</strong> {{ $order->shipping->city }}</p>
                <p><strong>{{ __('messages.state') }}:</strong> {{ $order->shipping->state }}</p>
                <p><strong>{{ __('messages.zip') }}:</strong> {{ $order->shipping->zip }}</p>
            </div>
        </div>

        <h3>{{ __('messages.order_details') }}</h3>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('messages.product') }}</th>
                    <th>{{ __('messages.price') }}</th>
                    <th>{{ __('messages.quantity') }}</th>
                    <th>{{ __('messages.total') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ number_format($item->price, 2) }} {{ __('messages.currency') }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->price * $item->quantity, 2) }} {{ __('messages.currency') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total-section">
            <table>
                <tr>
                    <th>{{ __('messages.subtotal') }}:</th>
                    <td>{{ number_format($order->subtotal, 2) }} {{ __('messages.currency') }}</td>
                </tr>
                @if($order->discount > 0)
                <tr>
                    <th>{{ __('messages.discount') }}:</th>
                    <td>{{ number_format($order->discount, 2) }} {{ __('messages.currency') }}</td>
                </tr>
                @endif
                <tr>
                    <th>{{ __('messages.grand_total') }}:</th>
                    <td><strong>{{ number_format($order->total, 2) }} {{ __('messages.currency') }}</strong></td>
                </tr>
            </table>
        </div>
    </div>

    <div class="invoice-footer">
        <p>{{ __('messages.thank_you') }}</p>
        <p>{{ config('app.name') }}</p>
        <small>{{ __('messages.invoice_issued_at') }}: {{ now()->format('Y-m-d H:i') }}</small>
    </div>
</body>
</html>
