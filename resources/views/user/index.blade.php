<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background: linear-gradient(135deg, #667eea, #764ba2);
    }

    .login-container {
      background-color: white;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
      width: 400px;
      max-width: 90%;
      animation: fadeIn 0.5s ease-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .login-container h1 {
      text-align: center;
      margin-bottom: 30px;
      color: #333;
    }

    .input-group {
      position: relative;
      margin-bottom: 20px;
    }

    .input-group input {
      width: 100%;
      padding: 12px 20px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 16px;
      transition: border-color 0.3s ease-in-out;
    }

    .input-group input:focus {
      outline: none;
      border-color: #667eea;
    }

    .input-group label {
      position: absolute;
      top: 50%;
      left: 20px;
      transform: translateY(-50%);
      color: #999;
      font-size: 16px;
      pointer-events: none;
      transition: all 0.3s ease-in-out;
    }

    .input-group input:focus + label,
    .input-group input:not(:placeholder-shown) + label {
      top: 0;
      left: 12px;
      font-size: 12px;
      color: #667eea;
      background-color: white;
      padding: 0 4px;
    }

    .login-button {
      width: 100%;
      background-color: #667eea;
      color: white;
      padding: 14px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
      transition: background-color 0.3s ease-in-out;
    }

    .login-button:hover {
      background-color: #5266d6;
    }

    .forgot-password {
      text-align: right;
      margin-top: 10px;
    }

    .forgot-password a {
      color: #667eea;
      text-decoration: none;
      font-size: 14px;
    }

    .forgot-password a:hover {
      text-decoration: underline;
    }

    .signup-link {
      text-align: center;
      margin-top: 20px;
      color: #666;
      font-size: 14px;
    }

    .signup-link a {
      color: #667eea;
      text-decoration: none;
    }

    .signup-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h1>Login</h1>
    <div class="input-group">
      <input type="email" id="email" placeholder=" " required>
      <label for="email">Email</label>
    </div>
    <div class="input-group">
      <input type="password" id="password" placeholder=" " required>
      <label for="password">Password</label>
    </div>
    <button class="login-button">Login</button>
    <div class="forgot-password">
      <a href="#">Forgot Password?</a>
    </div>
    <div class="signup-link">
      Don't have an account? <a href="#">Sign up</a>
    </div>
  </div>
</body>
</html>