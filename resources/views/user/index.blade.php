@if(session()->has('customer'))
<script>window.location="/customer/dashboard"</script>

@endif



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link rel="icon" href="{{url('assets/images/favicon-32x32.png')}}" type="image/png" />
  <!--plugins--> 
  <link href="{{url('assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
  <link href="{{url('assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
        <!-- loader-->
        
  <link href="{{url('assets/css/pace.min.css')}}" rel="stylesheet" />
  <script src="{{url('assets/js/pace.min.js')}}"></script>
  <!-- Bootstrap CSS -->
  <link href=" {{url('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
  <link href="{{url('assets/css/bootstrap-extended.css')}}" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet"/>
  <link href="assets/css/app.css" rel="stylesheet" />
  <link href="assets/css/icons.css" rel="stylesheet" />
  {{-- TOASTR  --}}
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <script src="{{url('project-js/alert_show.js')}}"></script>

        {{-- TOASTR  --}}


  <title>Login</title>
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
    <form id="customer_login">
      {{@csrf_field()}}
    <div class="input-group">
      <input type="email" id="email" placeholder="" name="username" required>
      <label for="email">Email</label>
    </div>
    <div class="input-group">
      <input type="password" id="password" placeholder=" " name="password" required>
      <label for="password">Password</label>
    </div>
    <button type="submit" class="login-button" id="loginBtn">Login</button>
    <div class="forgot-password">
      <a href="#">Forgot Password?</a>
    </div>
  </form>
    <div class="signup-link">
      Don't have an account? <a href="#">Sign up</a>
    </div>
  </div>
    <script src=" {{url('assets/js/bootstrap.bundle.min.js')}}"></script>
    <!--plugins-->
    <script src="{{url('assets/js/jquery.min.js')}}"></script>
    <script src="{{url('assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
    <script src="{{url('assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
    <script src="{{url('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>

    <!--app JS-->
    <script src="{{url('assets/js/app.js')}}"></script>
    <script src="{{url('project-js/jquery.js')}}"></script>
    <script src="{{url('project-js/validation.js')}}"></script>
    <script src="{{url('project-js/sweetalert.js')}}"></script>

    <script src="{{url('project-js/user/login.js')}}"></script>

</body>
</html>