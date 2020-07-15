<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>

    <style>
        .invoice-number-date {
            width: 100%;
        }

        .title p {
            font-size: 25px
        }

        .invoice-number {
            float: left;
        }

        .date {
            margin-left: 100px;
        }
    </style>
</head>
<body>
<div class="invoice">
    <div class="title">
        <p>
            <strong>INVOICE</strong>
        </p>
    </div>

    <div class="invoice-number-date">
        <div class="invoice-number">
            <div>Invoice number</div>
            <span>{{ rand(1000000, 9999999) }}</span>
        </div>

        <div class="date">
            <div>Date of Issue</div>
            <div>{{ \Carbon\Carbon::now()->format('d-m-Y') }}</div>
        </div>
    </div>

    <div style="width: 100%; max-width: 960px; margin: 30px 0 0 0">
        <table width="100%">
            <tr>
                <td style="padding-bottom: 16px;">
                    <strong>Billed To:</strong><br>
                    {{ $tenant }}<br>
                    Phone: {{ $phone }}
                    <br>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <h3>Description</h3>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <table width="100%" cellpadding="0" cellspacing="0" border="1">
                        <thead>
                        <tr style="background-color: #eee">
                            <th style="text-align: left; padding: 5px 10px;">Property</th>
                            <th style="text-align: center; padding: 5px 10px;">Address</th>
                            <th style="text-align: right; padding: 5px 10px;">Period</th>
                            <th style="text-align: center; padding: 5px 10px;">Monthly Rent</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td style="text-align: left; padding: 5px 10px;">{{ $property }}</td>
                            <td style="text-align: center; padding: 5px 10px;">{{ $address }}</td>
                            <td style="text-align: center; padding: 5px 10px;">
                                {{ Carbon\Carbon::parse($start_date)->format('d F, Y') }}
                                - {{Carbon\Carbon::parse($end_date)->format('d F, Y') }}
                            </td>
                            <td style="text-align: right; padding: 5px 10px;">${{ $monthly_rent }}</td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>
