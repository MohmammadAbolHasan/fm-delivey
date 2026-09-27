<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>Receipt #{{ $invoice->invoice_number }}</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: 'DejaVu Sans', sans-serif;
        }

        body {
            margin: 0;
            padding: 20px;
            background-color: #fff;
            color: #1a237e; /* لون أزرق داكن مطابق للصورة */
            font-size: 11px;
            direction: rtl;
        }

        .receipt-container {
            width: 100%;
            max-width: 800px;
            border: 2px solid #1a237e;
            padding: 10px;
            margin: 0 auto;
        }

        /* Top Header */
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
        }

        .header-table td {
            vertical-align: top;
        }

        .logo-section {
            width: 40%;
        }

        .logo-title {
            font-size: 24px;
            font-weight: bold;
            color: #1a237e;
            margin: 0;
            line-height: 1;
        }

        .logo-subtitle {
            font-size: 10px;
            color: #1a237e;
            margin-top: 3px;
            letter-spacing: 1px;
        }

        .support-box {
            width: 30%;
            border: 1px solid #1a237e;
            border-radius: 12px;
            padding: 6px;
            text-align: center;
            font-size: 10px;
        }

        .barcode-section {
            width: 30%;
            text-align: left;
        }

        .serial-no {
            color: #d32f2f; /* لون أحمر للرقم التسلسلي */
            font-size: 16px;
            font-weight: bold;
            margin-top: 5px;
        }

        /* Main Grid Table */
        .main-grid {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .main-grid th, .main-grid td {
            border: 1px solid #1a237e;
            padding: 6px;
            text-align: right;
        }

        .label-cell {
            background-color: #f5f5f5;
            font-weight: bold;
            width: 15%;
            white-space: nowrap;
        }

        .label-cell small {
            display: block;
            font-size: 8px;
            color: #555;
            font-weight: normal;
        }

        .value-cell {
            width: 35%;
            font-size: 12px;
        }

        /* Bottom Slogan & Phone */
        .footer-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        .slogan-cell {
            width: 30%;
            border: 1px solid #1a237e;
            text-align: center;
            padding: 5px;
            font-weight: bold;
            font-size: 10px;
        }

        .phone-cell {
            width: 70%;
            border: 1px solid #1a237e;
            padding: 5px 10px;
            text-align: right;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="receipt-container">

    <!-- Header Section -->
    <table class="header-table">
        <tr>
            <!-- Logo / Company Name -->
            <td class="logo-section">
                @if(file_exists(public_path('images/logo.png')))
                    <img src="{{ public_path('images/logo.png') }}" style="max-height: 45px; margin-bottom: 5px;">
                @else
                    <div class="logo-title">F.M</div>
                @endif
                <div class="logo-subtitle">FAST DELIVERY SERVICE</div>
            </td>

            <!-- Support Box -->
            <td style="padding: 0 10px;">
                <div class="support-box">
                    خدمة الزبائن والشكاوي
                    <br>
                    <strong>81 809 590</strong>
                </div>
            </td>

            <!-- Barcode & Serial No -->
            <td class="barcode-section">
                <!-- يمكنك استبدال صورة الباركود بالمكتبة الخاصة بك -->
                <div style="font-family: monospace; font-size: 16px; letter-spacing: 3px;">||||||||||||||||||||</div>
                <div class="serial-no">
                    Nº {{ $invoice->invoice_number }}
                </div>
            </td>
        </tr>
    </table>

    <!-- Grid Data Section -->
    <table class="main-grid">
        <tr>
            <td class="label-cell">
                إسم الشركة
                <small>Business Name</small>
            </td>
            <td class="value-cell">
                {{ $invoice->client->name ?? '' }}
            </td>
            <td class="label-cell">
                المرسل إليه
                <small>Receiver</small>
            </td>
            <td class="value-cell">
                {{ $invoice->receiver_name }}
            </td>
        </tr>

        <tr>
            <td class="label-cell">
                رقم الحساب
                <small>Account No.</small>
            </td>
            <td class="value-cell">
                {{ $invoice->account_no ?? '—' }}
            </td>
            <td class="label-cell">
                العنوان
                <small>Address</small>
            </td>
            <td class="value-cell">
                {{ $invoice->receiver_address }}
            </td>
        </tr>

        <tr>
            <td class="label-cell">
                عنوان الشركة
                <small>Business Address</small>
            </td>
            <td class="value-cell">
                {{ $invoice->client->address ?? '' }}
            </td>
            <td class="label-cell" rowspan="2">
                ملاحظات
                <small>Note</small>
            </td>
            <td class="value-cell" rowspan="2">
                {{ $invoice->notes }}
            </td>
        </tr>

        <tr>
            <td class="label-cell">
                رقم الهاتف
                <small>Phone</small>
            </td>
            <td class="value-cell">
                {{ $invoice->client->phone ?? '' }}
            </td>
        </tr>

        <tr>
            <td class="label-cell">
                المبلغ
                <small>Amount</small>
            </td>
            <td class="value-cell" style="font-size: 16px; font-weight: bold;">
                ${{ number_format($invoice->amount, 2) }}
            </td>
            <td class="label-cell">
                أجرة التوصيل
                <small>Delivery charge</small>
            </td>
            <td class="value-cell" style="font-size: 16px; font-weight: bold;">
                ${{ number_format($invoice->delivery_charge ?? 0, 2) }}
            </td>
        </tr>
    </table>

    <!-- Footer Section -->
    <table class="footer-table">
        <tr>
            <td class="slogan-cell">
                WE LIVE TO<br>SAVE TIME
            </td>
            <td class="phone-cell">
                <span style="float: right;">
                    رقم الهاتف: {{ $invoice->receiver_phone }}
                </span>
                <span style="float: left;">
                    التاريخ (Date): {{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d-m-Y') }}
                </span>
            </td>
        </tr>
    </table>

</div>

</body>
</html>