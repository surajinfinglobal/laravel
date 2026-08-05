<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice {{ $invoice['invoice_number'] }}</title>
</head>
<body style="margin:0;padding:0;background:#0f0f17;font-family:'Segoe UI',Arial,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#0f0f17;padding:40px 16px;">
<tr>
<td align="center">

    {{-- Main Card --}}
    <table width="560" cellpadding="0" cellspacing="0" style="background:#1a1a2e;border-radius:16px;border:1px solid #2a2a40;overflow:hidden;max-width:560px;width:100%;">

        {{-- Header --}}
        <tr>
            <td style="padding:28px 32px 20px;border-bottom:1px solid #2a2a40;">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td valign="middle">
                            <table cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="width:40px;height:40px;background:linear-gradient(135deg,#7c3aed,#2563eb);border-radius:10px;text-align:center;vertical-align:middle;color:#fff;font-size:16px;font-weight:700;">
                                        &lt;/&gt;
                                    </td>
                                    <td style="padding-left:12px;">
                                        <div style="color:#e2e8f0;font-size:18px;font-weight:700;">Dev<span style="color:#60a5fa;">Connect</span></div>
                                        <div style="color:#94a3b8;font-size:12px;">Payment Invoice</div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td align="right" valign="top">
                            <div style="color:#94a3b8;font-size:11px;margin-bottom:2px;">Invoice</div>
                            <div style="color:#e2e8f0;font-size:14px;font-weight:600;">#{{ $invoice['invoice_number'] }}</div>
                            <div style="color:#94a3b8;font-size:11px;margin-top:8px;">Date</div>
                            <div style="color:#e2e8f0;font-size:13px;">
                                {{ \Carbon\Carbon::parse($invoice['paid_at'])->format('d M Y, h:i A') }}
                            </div>
                            <div style="margin-top:10px;">
                                <span style="display:inline-block;background:#14532d;color:#4ade80;border:1px solid #166534;font-size:11px;font-weight:700;padding:4px 12px;border-radius:20px;letter-spacing:0.5px;">
                                    ✓ PAID
                                </span>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        {{-- Billed To --}}
        <tr>
            <td style="padding:24px 32px 8px;">
                <div style="color:#94a3b8;font-size:11px;margin-bottom:4px;">Billed To</div>
                <div style="color:#e2e8f0;font-size:15px;font-weight:600;">{{ $invoice['user_name'] }}</div>
                <div style="color:#94a3b8;font-size:13px;">{{ $invoice['user_email'] }}</div>
            </td>
        </tr>

        {{-- Details --}}
        <tr>
            <td style="padding:16px 32px 8px;">
                <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">

                    <tr>
                        <td style="padding:12px 0;border-bottom:1px solid #2a2a40;color:#94a3b8;font-size:14px;">Plan</td>
                        <td style="padding:12px 0;border-bottom:1px solid #2a2a40;color:#e2e8f0;font-size:14px;text-align:right;font-weight:600;">
                            {{ strtoupper($invoice['plan']) }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:12px 0;border-bottom:1px solid #2a2a40;color:#94a3b8;font-size:14px;">Billing Cycle</td>
                        <td style="padding:12px 0;border-bottom:1px solid #2a2a40;color:#e2e8f0;font-size:14px;text-align:right;">
                            {{ ucfirst($invoice['billing']) }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:12px 0;border-bottom:1px solid #2a2a40;color:#94a3b8;font-size:14px;">Payment Method</td>
                        <td style="padding:12px 0;border-bottom:1px solid #2a2a40;color:#e2e8f0;font-size:14px;text-align:right;">
                            {{ strtoupper($invoice['payment_method']) }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:12px 0;border-bottom:1px solid #2a2a40;color:#94a3b8;font-size:14px;">Subtotal</td>
                        <td style="padding:12px 0;border-bottom:1px solid #2a2a40;color:#a78bfa;font-size:14px;text-align:right;font-weight:600;">
                            ${{ number_format($invoice['amount'], 2) }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:16px 0 8px;color:#e2e8f0;font-size:16px;font-weight:700;">Total Paid</td>
                        <td style="padding:16px 0 8px;color:#a78bfa;font-size:18px;text-align:right;font-weight:700;">
                            ${{ number_format($invoice['amount'], 2) }}
                        </td>
                    </tr>

                </table>
            </td>
        </tr>

        {{-- Footer --}}
        <tr>
            <td style="padding:24px 32px 28px;border-top:1px solid #2a2a40;">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="color:#64748b;font-size:12px;line-height:1.5;">
                            Thank you for upgrading on DevConnect.<br>
                            This is a computer-generated invoice.
                        </td>
                        <td align="right">
                            <a href="{{ config('app.url') }}/home/myproject"
                               style="display:inline-block;background:linear-gradient(135deg,#7c3aed,#2563eb);color:#ffffff;text-decoration:none;font-size:13px;font-weight:600;padding:10px 20px;border-radius:8px;">
                                Go to Dashboard →
                            </a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

    </table>

    {{-- Bottom note --}}
    <table width="560" cellpadding="0" cellspacing="0" style="max-width:560px;width:100%;margin-top:20px;">
        <tr>
            <td align="center" style="color:#475569;font-size:11px;line-height:1.6;">
                © {{ date('Y') }} DevConnect. All rights reserved.<br>
                You received this email because you completed a payment.
            </td>
        </tr>
    </table>

</td>
</tr>
</table>

</body>
</html>