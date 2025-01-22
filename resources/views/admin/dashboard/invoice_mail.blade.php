<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Invoice</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f7f7f7; font-family: Arial, sans-serif;">
    <!-- Main Table -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f7f7f7;">
        <tr>
            <td align="center" style="padding: 40px 0;">
                <!-- Content Table -->
                <table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                    <!-- Header -->
                    <tr>
                        <td align="left" style="padding: 40px 40px 20px 40px;">
                            <h1 style="margin: 0; font-size: 36px; color: #333333;">INVOICE</h1>
                        </td>
                        <td align="right" style="padding: 40px 40px 20px 40px;">
                            <div style="background-color: #008B8B; padding: 10px 20px; display: inline-block; border-radius: 4px;">
                                <span style="color: #ffffff; font-size: 14px;">UNPAID</span>
                            </div>
                        </td>
                    </tr>

                    <!-- Invoice Info -->
                    <tr>
                        <td colspan="2" style="padding: 0 40px;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td width="50%" style="padding: 20px; background-color: #f8f9fa; border-radius: 8px;">
                                        <p style="margin: 0 0 10px 0; color: #666666; font-size: 14px;">Date Issued:</p>
                                        <p style="margin: 0; font-size: 16px; color: #333333;"> <?php echo date("d M Y"); ?> </p>
                                        <p style="margin: 15px 0 10px 0; color: #666666; font-size: 14px;">Invoice No:</p>
                                        <p style="margin: 0; font-size: 16px; color: #333333;">01234</p>
                                    </td>
                                    <td width="20">&nbsp;</td>
                                    <td width="50%" style="padding: 20px; background-color: #f8f9fa; border-radius: 8px;">
                                        <p style="margin: 0 0 10px 0; color: #666666; font-size: 14px;">Issued To:</p>
                                        <p style="margin: 0 0 5px 0; font-size: 16px; color: #333333;">{{$clients->customer_name}}</p>
                                        <p style="margin: 0; font-size: 14px; color: #666666; line-height: 1.5;">
                                            {{$clients->address}} <br>
                                            {{$clients->city}} <br>
                                            {{$clients->state}} <br>
                                            {{$clients->zip}} <br>
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Items Table -->
                    <tr>
                        <td colspan="2" style="padding: 40px;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
                                <tr style="background-color: #f8f9fa;">
                                    <th align="left" style="padding: 15px; border-top: 1px solid #dee2e6; border-bottom: 1px solid #dee2e6; color: #333333; font-size: 14px;">NO</th>
                                    <th align="left" style="padding: 15px; border-top: 1px solid #dee2e6; border-bottom: 1px solid #dee2e6; color: #333333; font-size: 14px;">PACKAGE TITLE</th>
                                    <th align="center" style="padding: 15px; border-top: 1px solid #dee2e6; border-bottom: 1px solid #dee2e6; color: #333333; font-size: 14px;">QTY</th>
                                    <th align="right" style="padding: 15px; border-top: 1px solid #dee2e6; border-bottom: 1px solid #dee2e6; color: #333333; font-size: 14px;">PRICE</th>
                                </tr>
                                <tr>
                                    <td style="padding: 15px; border-bottom: 1px solid #dee2e6; color: #666666; font-size: 14px;">1</td>
                                    <td style="padding: 15px; border-bottom: 1px solid #dee2e6; color: #666666; font-size: 14px;">{{$invoice_details->title}}</td>
                                    <td align="center" style="padding: 15px; border-bottom: 1px solid #dee2e6; color: #666666; font-size: 14px;">1</td>
                                    <td align="right" style="padding: 15px; border-bottom: 1px solid #dee2e6; color: #666666; font-size: 14px;">$ {{$invoice_details->price}}</td>
                                </tr>
                                <tr>
                                    <td colspan="4" align="right" style="padding: 15px; font-weight: bold; color: #333333; font-size: 14px;">GRAND TOTAL</td>
                                    <td align="right" style="padding: 15px; font-weight: bold; color: #333333; font-size: 14px;">${{$invoice_details->price}} </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Bank Details -->
                    <tr>
                        <td colspan="2" style="padding: 0 40px 40px 40px;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f8f9fa; border-radius: 8px;">
                                <tr>
                                    <td style="padding: 20px;">
                                        <p style="margin: 0 0 10px 0; color: #333333; font-weight: bold; font-size: 14px;">Note:</p>
                                        <p style="margin: 0 0 5px 0; color: #666666; font-size: 14px;">Click to the link for the payment :</p>
                                        <p style="margin: 0; color: #666666; font-size: 14px;">Payment Link: <a href="{{$payment_link}}">Click Here to Pay</a></p>
                                    </td>
                                    <td align="right" style="padding: 20px;">
                                        <p style="margin: 0 0 5px 0; color: #333333; font-size: 16px;">Thank You</p>
                                        <p style="margin: 0; color: #666666; font-size: 14px;">Orarah</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>