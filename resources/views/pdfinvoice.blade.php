<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $invoice['invoice_number'] ?? $invoice->invoice_number }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #1e293b;
            line-height: 1.5;
        }
        .wrap { padding: 30px; }
        .header {
            width: 100%;
            margin-bottom: 28px;
            border-bottom: 2px solid #7c3aed;
            padding-bottom: 16px;
        }
        .header td { vertical-align: top; }
        .brand {
            font-size: 20px;
            font-weight: bold;
            color: #7c3aed;
        }
        .brand span { color: #2563eb; }
        .sub { font-size: 11px; color: #64748b; margin-top: 2px; }
        .meta { text-align: right; font-size: 11px; color: #475569; }
        .meta strong { color: #1e293b; font-size: 12px; }
        .badge {
            display: inline-block;
            background: #dcfce7;
            color: #166534;
            border: 1px solid #86efac;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: bold;
            margin-top: 6px;
        }
        table.details {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table.details th {
            text-align: left;
            background: #f1f5f9;
            color: #475569;
            font-size: 11px;
            padding: 10px 12px;
            border-bottom: 1px solid #e2e8f0;
        }
        table.details td {
            padding: 10px 12px;
            border-bottom: 1px solid #e2e8f0;
            color: #334155;
        }
        table.details tr:last-child td { border-bottom: none; }
        .right { text-align: right; }
        .total-row td {
            font-size: 14px;
            font-weight: bold;
            color: #1e293b;
            background: #f8fafc;
            border-top: 2px solid #7c3aed;
        }
        .price { color: #7c3aed; font-weight: bold; }
        .footer {
            margin-top: 36px;
            padding-top: 14px;
            border-top: 1px solid #e2e8f0;
            font-size: 10px;
            color: #94a3b8;
        }
    </style>
</head>
<body>
@php
    $inv = is_array($invoice) ? (object) $invoice : $invoice;

    // user relation / nested array
    $user = $inv->user ?? null;
    if (is_array($user)) {
        $user = (object) $user;
    }

    $userName  = $user->name  ?? ($inv->user_name  ?? 'Customer');
    $userEmail = $user->email ?? ($inv->user_email ?? '');

    $amount = number_format((float) ($inv->amount ?? 0), 2);
    $date = isset($inv->paid_at)
        ? \Carbon\Carbon::parse($inv->paid_at)->format('d M Y, h:i A')
        : (isset($inv->created_at)
            ? \Carbon\Carbon::parse($inv->created_at)->format('d M Y, h:i A')
            : now()->format('d M Y, h:i A'));
@endphp

<div class="wrap">

    <table class="header">
        <tr>
            <td>
                <div class="brand">Dev<span>Connect</span></div>
                <div class="sub">Payment Invoice</div>
            </td>
            <td class="meta">
                <div>Invoice</div>
                <strong>#{{ $inv->invoice_number }}</strong><br><br>
                <div>Date</div>
                <strong>{{ $date }}</strong><br>
                <span class="badge">{{ strtoupper($inv->status ?? 'PAID') }}</span>
            </td>
        </tr>
    </table>
<div style="margin-bottom: 20px;">
    <div style="font-size: 10px; color: #94a3b8; margin-bottom: 4px;">Billed To</div>
    <div style="font-size: 13px; font-weight: bold; color: #1e293b;">{{ $userName }}</div>
    <div style="font-size: 11px; color: #64748b;">{{ $userEmail }}</div>
</div>
    <table class="details">
        <thead>
            <tr>
                <th>Description</th>
                <th class="right">Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <strong>{{ strtoupper($inv->plan ?? '') }} Plan</strong><br>
                    <span style="color:#64748b;font-size:11px;">
                        Billing: {{ ucfirst($inv->billing ?? '') }}
                        &nbsp;|&nbsp;
                        Method: {{ strtoupper($inv->payment_method ?? '') }}
                    </span>
                </td>
                <td class="right price">${{ $amount }}</td>
            </tr>
            <tr>
                <td>Subtotal</td>
                <td class="right">${{ $amount }}</td>
            </tr>
            <tr class="total-row">
                <td>Total Paid</td>
                <td class="right price">${{ $amount }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        Thank you for upgrading on DevConnect.<br>
        This is a computer-generated invoice. No signature required.
    </div>

</div>
</body>
</html>