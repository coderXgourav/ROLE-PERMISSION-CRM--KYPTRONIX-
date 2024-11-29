@include('admin.dashboard.header')

{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title> --}}
    <style>
        .body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 20px;
            border-bottom: 2px solid #1a73e8;
        }
        .logo {
            width: 50px;
            height: 50px;
        }
        .company-info {
            text-align: right;
        }
        .company-name {
            font-weight: bold;
            font-size: 1.2em;
        }
        .company-tagline {
            color: #777;
            font-size: 0.9em;
        }
        .invoice-details {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .col {
            flex: 1;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #1a73e8;
            color: white;
        }
        .amount-due {
            text-align: right;
            margin-top: 20px;
            font-weight: bold;
        }
        .notes {
            margin-top: 30px;
            font-style: italic;
            color: #777;
        }
    </style>
</head>
<div class="body">
    <div><br>
        @if ($invoice_details->payment_status>0)
        <span class="alert alert-sm alert-success" style="">Paid</span>
            @else 
        <span class="alert alert-sm alert-danger" style="">Unpaid</span>
        @endif
    </div>
    <div class="header">
        <h1>Invoice 
            

        </h1>
       
        <div class="company-info">
            <img src="/assets/images/logo-icon.png" style="width: 75px;" alt="">
            <div class="company-tagline"></div>
            <div class="company-name" style="text-align: center">Oradah</div>
        </div>
        
    </div>
  <form id="invoice_email_send">
     {{@csrf_field()}}
    <input type="hidden" name="customer_id" value="{{$clients->customer_id}}">
    <input type="hidden" name="invoice_id" value="{{$invoice_details->invoice_id}}">

    <div class="invoice-details"> 
        <div class="col">
            <h3>From</h3>
            <p>{{$admin_data->first_name}} {{$admin_data->last_name}}<br>
            {{$admin_data->email_address}}<br>
            Your address<br>
            P: {{$admin_data->phone_number}}</p>
        </div>
        <div class="col">
            <h3>For</h3>
            <p>{{$clients->customer_name}}<br>
            {{$clients->customer_email}}<br>
            Client address<br>
            P: {{$clients->customer_number}}</p>
        </div>
        <div class="col">
            <p><strong>Number:</strong>{{$invoice_details->invoice_unique_id}}<br>
            <strong>Date:</strong> 04 May 2018<br>
            <strong>Terms:</strong> Next Day<br>
            <strong>Due:</strong> 05 May 2018</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Title</th>
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
                <td>{{$package_details->title}}</td>
                <td>{{$invoice_details->price}}$</td>
            </tr>
          <?php }  ?>
        </tbody>
    </table>

    <div class="amount-due">
        <p>Subtotal: <b>{{$invoice_details->price}}$</b><br>
      <!--  Tax (7%): $6.93<br>
        Total: $105.93</p>
        <h3>Balance Due: $105.93</h3>-->
    </div>
     <div style="display: flex; justify-content:center; margin-top:15px;">
        <button type="submit" id="btn" style="height:46px;" class="m-auto btn btn-primary">Send Invoice </button>
     </div>
    </form>
    <div class="notes">
        <p>Notes: any relevant info, terms, payment instructions, e.t.c</p>
    </div>
</div>
{{-- </html> --}}
@include('admin.dashboard.footer')
