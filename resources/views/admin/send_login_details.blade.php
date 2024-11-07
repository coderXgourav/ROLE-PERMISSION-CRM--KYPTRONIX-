<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Details</title>
  <!--[if gte mso 9]>
  <xml>
    <o:OfficeDocumentSettings>
      <o:AllowPNG/>
      <o:PixelsPerInch>96</o:PixelsPerInch>
    </o:OfficeDocumentSettings>
  </xml>
  <![endif]-->
  <style>
    /* Define some basic styles */
    body {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
    }

    table {
      border-collapse: collapse;
      border-spacing: 0;
    }

    td {
      padding: 0;
    }

    /* Define email styles */
    .wrapper {
      width: 100%;
      table-layout: fixed;
      background-color: #f4f4f4;
      padding-bottom: 40px;
    }

    .main {
      background-color: #fff;
      margin: 0 auto;
      width: 100%;
      max-width: 600px;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .logo {
      padding: 30px;
      text-align: center;
      background-color: #2980b9;
    }

    .logo img {
      max-width: 150px;
    }

    .content {
      padding: 40px;
    }

    .title {
      color: #2c3e50;
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 20px;
    }

    .message {
      color: #7f8c8d;
      font-size: 16px;
      line-height: 1.6;
      margin-bottom: 30px;
    }

    .cta {
      background-color: #2980b9;
      color: #fff;
      display: inline-block;
      padding: 14px 30px;
      border-radius: 6px;
      text-decoration: none;
      font-size: 16px;
      transition: background-color 0.3s ease;
    }

    .cta:hover {
      background-color: #2471a3;
    }

    .footer {
      background-color: #2c3e50;
      color: #fff;
      text-align: center;
      padding: 20px;
      font-size: 14px;
    }

    .footer a {
      color: #fff;
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .footer a:hover {
      color: #bdc3c7;
    }
  </style>
</head>
<body> <br>
  <center class="wrapper">
    <table class="main" width="100%" cellpadding="0" cellspacing="0">
      <tr>
        <td class="logo">
          <img src="{{url('/assets/images/logo-icon.png')}}" alt="Company Logo">
        </td>
      </tr>
      <tr>
        <td class="content">
          <h1 class="title">Welcome to Our Platform</h1>
          <p class="message">We're excited to have you on board! Please find your login details below:</p>
          <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
              <td>
                <p>Email Address: <strong>{{$email}}</strong></p>
                <p>Password: <strong>{{$password}}</strong></p>
              </td>
            </tr>
          </table>
          <br>
          <a href="https://oradah-crm.kyptronix.co.in/customer/login" class="cta" style="color: white;">Login to Your Account</a>
        </td>
      </tr>
      <tr>
        <td class="footer">
          &copy; {{Date('Y')}} Oradah. All rights reserved. | <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a>
        </td>
      </tr>
    </table>
  </center> <br>
</body>
</html>