<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .success-card {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 500px;
            width: 100%;
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from {
                transform: translateY(30px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .success-icon {
            width: 90px;
            height: 90px;
            background: #4BB543;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            animation: scaleIn 0.5s ease-out 0.5s both;
        }

        @keyframes scaleIn {
            from {
                transform: scale(0);
            }
            to {
                transform: scale(1);
            }
        }

        .success-icon i {
            color: white;
            font-size: 45px;
        }

        h1 {
            color: #2d3436;
            margin-bottom: 15px;
            font-size: 28px;
        }

        .message {
            color: #636e72;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .order-details {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
        }

        .order-details p {
            margin: 10px 0;
            color: #2d3436;
        }

        .order-details .amount {
            font-size: 24px;
            color: #2d3436;
            font-weight: bold;
        }

        .btn {
            background: #4BB543;
            color: white;
            padding: 15px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-block;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background: #429a3a;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(75, 181, 67, 0.4);
        }

        .complementary-text {
            margin-top: 20px;
            font-size: 14px;
            color: #7f8c8d;
        }
    </style>
</head>
<body>
    <div class="success-card">
        <div class="success-icon">
            <i class="fas fa-check"></i>
        </div>
        <h1>Payment Successful!</h1>
        <p class="message">Thank you for your purchase. Your transaction has been completed successfully.</p>
        
        <div class="order-details">
            <p>Order #: 2024110601</p>
            <p class="amount">${{$amount}}</p>
            {{-- <p>Date: November 6, 2024</p> --}}
            <p>Date: {{Date('M d, Y')}}</p>
        </div>

        <a href="#" class="btn">Go Back</a>
        
        <p class="complementary-text">Need help? Contact our support team 24/7</p>
    </div>
</body>
</html>