<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Invoice</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            padding: 2rem;
        }

        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #f0f0f0;
        }

        .company-logo {
            width: 150px;
            height: 50px;
            background-color: #2563eb;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .invoice-info {
            text-align: right;
        }

        .invoice-title {
            color: #1f2937;
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .invoice-details {
            color: #6b7280;
            font-size: 0.9rem;
        }

        .addresses {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
        }

        .address-block {
            flex: 1;
            max-width: 250px;
        }

        .address-block h3 {
            color: #4b5563;
            margin-bottom: 0.5rem;
            font-size: 1rem;
        }

        .address-content {
            color: #6b7280;
            font-size: 0.9rem;
            line-height: 1.5;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2rem;
        }

        th {
            background-color: #2563eb;
            color: white;
            text-align: left;
            padding: 1rem;
            font-weight: 500;
        }

        td {
            padding: 1rem;
            border-bottom: 1px solid #e5e7eb;
            color: #4b5563;
        }

        .total-row {
            background-color: #f8fafc;
            font-weight: bold;
        }

        .btn-send {
            background-color: #2563eb;
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        .btn-send:hover {
            background-color: #1d4ed8;
        }

        .notes {
            margin-top: 2rem;
            padding-top: 1rem;
            border-top: 2px solid #f0f0f0;
            color: #6b7280;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <div class="company-logo">
               <img src="https://kyptronix.us/images/webp/logo.webp" style="width: 85px;" alt="">
                Kyptronix LLP
            </div>
            <div class="invoice-info">
                <h1 class="invoice-title">Invoice</h1>
                <div class="invoice-details">
                    <p>Number: INV0001</p>
                    <p>Date: 04 May 2018</p>
                    <p>Due: 05 May 2018</p>
                    <p>Terms: Next Day</p>
                </div>
            </div>
        </div>

        <div class="addresses">
            <div class="address-block">
                <h3>From</h3>
                <div class="address-content">
                    <p>{{$admin_data->first_name}} {{$admin_data->last_name}}</p>
                    <p>{{$admin_data->email_address}}</p>
                    <p>Your address</p>
                    <p>P: {{$clients->customer_number}}</p>
                </div>
            </div>

            <div class="address-block">
                <h3>For</h3>
                <div class="address-content">
                    <p>{{$clients->customer_name}}</p>
                    <p>{{$clients->customer_email}}</p>
                    <p>Client address</p>
                    <p>P: {{$clients->customer_number}}</p>
                </div>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
             <?php if(!empty($invoice_details)){
                $timestamp = strtotime($invoice_details->created_at);
                $date = date('d-M-Y', $timestamp);

             ?>
          
                <tr>
                    <td>{{$date}}</td>
                    <td>{{$invoice_details->description}}</td>
                    <td>{{$invoice_details->price}}$</td>
                </tr>
                <tr class="total-row">
                    <td colspan="2" style="text-align: right">Subtotal:</td>
                    <td><b>{{$invoice_details->price}}$</b></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <div class="notes">
            Notes: any relevant info, terms, payment instructions, etc
        </div>
    </div>
</body>
</html>