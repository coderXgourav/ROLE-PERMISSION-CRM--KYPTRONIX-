<!DOCTYPE html>
<head>
    <style>
        #m_-7726197597817698929mainbox{
            display:flex !important;
            justify-content:space-between !important;
        }
        #m_-7726197597817698929mainbox2{
            display:flex !important;
            justify-content:space-between !important;
        }
    </style>
</head>
<html lang="en" style="margin: 0; padding: 0; box-sizing: border-box;">
<body style="font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif; line-height: 1.6; color: #1e293b; max-width: 850px; margin: 20px auto; padding: 20px; background-color: #f8fafc;">
    <div style="background: #ffffff; border-radius: 16px; padding: 48px; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);">
        <!-- Header Section -->
        <div id="mainbox" >
            <div style="flex: 1; justify-content:space-between;">
                <img src="/assets/images/logo-icon.png" style="width: 75px;" alt="">
                <h2 style="font-size: 1.5rem; font-weight: 700; color: #1e40af; letter-spacing: -0.025em; margin: 0;">Oradah</h2>
                <p style="color: #64748b; font-size: 0.875rem; margin-top: 4px;">Professional Business Solutions</p>
            </div>
            <div style="text-align: right;">
                <h1 style="color: #1e40af; font-size: 2.75rem; font-weight: 800; letter-spacing: -0.05em; margin-bottom: 16px; text-transform: uppercase;">Invoice</h1>
                <div style="background: #f1f5f9; padding: 16px 20px; border-radius: 12px; font-size: 0.9rem;">
                    <p style="margin: 6px 0;"><strong>Invoice No:</strong> {{$invoice_details->invoice_unique_id}}</p>
                    <p style="margin: 6px 0;"><strong>Issue Date:</strong> {{$invoice_details->date}}</p>
                    <div style="display: inline-block; padding: 4px 12px; background: #059669; color: white; border-radius: 6px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; margin-top: 8px;">Unpaid</div>
                </div>
            </div>
        </div> <br>

        <!-- Invoice Details -->
        <div id="mainbox2" >
            <div style="padding: 24px; background: #f1f5f9; border-radius: 12px; position: relative; border-left: 4px solid #3b82f6;">
                <h3 style="color: #1e40af; font-size: 1.25rem; font-weight: 600; margin-bottom: 16px; letter-spacing: -0.025em;">From</h3>
                <div style="color: #64748b;">
                    <p style="margin: 8px 0;"><strong style="color: #1e293b; font-weight: 500;">Oradah</strong></p>
                    <p style="margin: 8px 0;">30 N Gould St Ste R</p>
                    <p style="margin: 8px 0;">Sheridan</p>
                    <p style="margin: 8px 0;">WY, 82801</p>
                    <p style="margin: 8px 0;">Phone:  +1(617) 35-18006 </p>
                    <p style="margin: 8px 0;">Email: oradahinc@gmail.com</p>
                </div>
            </div>

            <div style="padding: 24px; background: #f1f5f9; border-radius: 12px; position: relative; border-left: 4px solid #3b82f6;">
                <h3 style="color: #1e40af; font-size: 1.25rem; font-weight: 600; margin-bottom: 16px; letter-spacing: -0.025em;">Bill To</h3>
                <div style="color: #64748b;">
                    <p style="margin: 8px 0;"><strong style="color: #1e293b; font-weight: 500;">{{$clients->customer_name}}</strong></p>
                    <p style="margin: 8px 0;">{{$clients->address}}</p>
                    <p style="margin: 8px 0;">{{$clients->state, $clients->zip}}</p>
                    <p style="margin: 8px 0;">Phone: {{$clients->customer_number}}</p>
                    <p style="margin: 8px 0;">Email: {{$clients->customer_email}}</p>
                </div>
            </div>
        </div>

        <!-- Items Table -->
        <table style="width: 100%; border-collapse: collapse; margin: 32px 0; font-size: 0.95rem;">
            <thead>
                <tr style="background: #1e40af; color: white;">
                    <th style="padding: 16px; text-align: left; font-weight: 600; letter-spacing: 0.025em; border-top-left-radius: 12px;">Description</th>
                    {{-- <th style="padding: 16px; text-align: left; font-weight: 600; letter-spacing: 0.025em;">Quantity</th> --}}
                    <th style="padding: 16px; text-align: right; font-weight: 600; letter-spacing: 0.025em; border-top-right-radius: 12px;">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid #e2e8f0;">
                    <td style="padding: 16px;">
                        <div style="font-weight: 500; color: #1e293b;">{{$invoice_details->description}}</div>
                    </td>
                    {{-- <td style="padding: 16px;">1</td> --}}
                    <td style="padding: 16px; text-align: right;">${{$invoice_details->amount==null ? $invoice_details->price : $invoice_details->amount}}</td>
                </tr>
            </tbody>
        </table>

        <!-- Footer -->
        <div style="margin-top: 48px; text-align: center;">
            {{-- <h3 style="font-size: 1.5rem; color: #1e40af; font-weight: 600; margin-bottom: 16px; letter-spacing: -0.025em;">Thank You for Your Business!</h3> --}}
            <div style="margin-top: 24px; padding: 24px; background: #f1f5f9; border-radius: 12px; text-align: left;">
                <h4 style="color: #1e40af; margin-bottom: 12px; font-size: 1.1rem;">Payment Link</h4>
                <div style="background: white; padding: 16px; border-radius: 8px; margin-top: 16px;">
                    {{-- <p style="margin: 8px 0; color: #64748b;"><strong style="color: #1e293b;">Click to stripe link & pay:</strong></p> --}}
                    <p style="margin: 8px 0; color: #64748b;">{{env('APP_URL')}}/admin/pay?invoice={{Crypt::encrypt($invoice_details->invoice_id)}}&customer={{Crypt::encrypt($invoice_details->customer_id)}}</p>
                   
                </div>
            
            </div>
        </div>
    </div>
</body>
</html>