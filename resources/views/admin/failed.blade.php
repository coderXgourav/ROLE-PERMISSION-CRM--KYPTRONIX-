<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Failed</title>
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
            background: linear-gradient(135deg, #f5f7fa 0%, #e3e3e3 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .failed-card {
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

        .failed-icon {
            width: 90px;
            height: 90px;
            background: #dc3545;
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

        .failed-icon i {
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

        .error-details {
            background: #fff5f5;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            border: 1px solid #ffebeb;
        }

        .error-details p {
            margin: 10px 0;
            color: #2d3436;
        }

        .error-code {
            font-family: monospace;
            background: #ffebeb;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 14px;
            color: #dc3545;
        }

        .button-group {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 15px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-block;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: #dc3545;
            color: white;
        }

        .btn-secondary {
            background: #f8f9fa;
            color: #2d3436;
            border: 1px solid #dee2e6;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .btn-primary:hover {
            background: #c82333;
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
        }

        .btn-secondary:hover {
            background: #e2e6ea;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .support-options {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
        }

        .support-options h3 {
            color: #2d3436;
            font-size: 18px;
            margin-bottom: 15px;
        }

        .contact-methods {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 15px;
        }

        .contact-method {
            color: #636e72;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .contact-method:hover {
            color: #2d3436;
        }
    </style>
</head>
<body>
    <div class="failed-card">
        <div class="failed-icon">
            <i class="fas fa-times"></i>
        </div>
        <h1>Payment Failed</h1>
        <p class="message">We're sorry, but we couldn't process your payment. Please verify your payment information and try again.</p>
        
        <div class="error-details">
            <p>Transaction ID: <span class="error-code">TXN-2024110602</span></p>
            <p>Error Code: <span class="error-code">ERR-5123</span></p>
            <p>Reason: Insufficient funds or card declined</p>
        </div>

        <div class="button-group">
            <a href="#" class="btn btn-primary">Try Again</a>
        </div>
        
        <div class="support-options">
            <h3>Need Help?</h3>
            <p>Our support team is here to assist you</p>
            <div class="contact-methods">
                <a href="#" class="contact-method">
                    <i class="fas fa-envelope"></i>
                   oradahinc@gmail.com
                </a>
                <a href="#" class="contact-method">
                    <i class="fas fa-phone"></i>
                  +1 (617)-351-8006
                </a>
               
            </div>
        </div>
    </div>
</body>
</html>