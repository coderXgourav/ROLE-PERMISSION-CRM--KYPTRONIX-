<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from codervent.com/syndron/demo/vertical/auth-basic-forgot-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 08 Jun 2023 07:09:54 GMT -->
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
	<!-- loader-->
	<link href="{{url('assets/css/pace.min.css')}}" rel="stylesheet" />
	<script src="{{url('assets/js/pace.min.js')}}"></script>
	<!-- Bootstrap CSS -->
	<link href="{{url('assets/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{url('assets/css/bootstrap-extended.css')}}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
	<link href="{{url('assets/css/app.css')}}" rel="stylesheet">
	<link href="{{url('assets/css/icons.css')}}" rel="stylesheet">
	 {{-- TOASTR  --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script src="{{url('project-js/alert_show.js')}}"></script>

        {{-- TOASTR  --}}
	<title>Syndron - Bootstrap 5 Admin Dashboard Template</title>
</head>

<body class="">
	<!-- wrapper -->
	<div class="wrapper">
		<div class="authentication-forgot d-flex align-items-center justify-content-center">
			<div class="card forgot-box">
				<form id="forget_password" >
				<div class="card-body">
					<div class="p-3">
						<div class="text-center">
							<img src="{{url('assets/images/icons/forgot-2.png')}}" width="100" alt="" />
						</div>
						<h4 class="mt-5 font-weight-bold">Forgot Password?</h4>
						<p class="text-muted">Enter your registered email ID to reset the password</p>
						<div class="my-4">
							<label class="form-label">Email id</label>
							<input name="email" type="text" class="form-control" placeholder="Type Email Here" />
						</div>
						<div class="d-grid gap-2">
							{{@csrf_field()}}
							<button type="submit" id="btn" style="height:45px;" class="btn btn-primary">Send</button>
							 <a href="{{url('/admin')}}" class="btn btn-light"><i class='bx bx-arrow-back me-1'></i>Back to Login</a>
						</div>
					</div>
				</div>
			</form>
			<form id="otp_form" style="display: none;">
				<div class="card-body">
					<div class="p-3">
						<div class="text-center">
							<img src="{{url('assets/images/icons/forgot-2.png')}}" width="100" alt="" />
						</div>
						<h4 class="mt-5 font-weight-bold">OTP Varify?</h4>
						<p class="text-muted">Enter your Varify OTP Number to reset the password</p>
						
						<div class="my-4">
							<label class="form-label">OTP </label>
							<input name="otp" type="text" class="form-control" placeholder="Enter OTP Here" />
						</div>
						<div class="d-grid gap-2">
							{{@csrf_field()}}
							<button type="submit" id="btn2" style="height:45px;" class="btn btn-primary">Submit</button>
							 <a href="{{url('/admin')}}" class="btn btn-light"><i class='bx bx-arrow-back me-1'></i>Back to Login</a>
						</div>
					</div>
				</div>
			</form>
			<form id="new_password_form" style="display: none;">
				<div class="card-body">
					<div class="p-3">
						<div class="text-center">
							<img src="{{url('assets/images/icons/forgot-2.png')}}" width="100" alt="" />
						</div>
						<h4 class="mt-5 font-weight-bold">Change Password? </h4>
						<p class="text-muted">Enter your New Password to change Your Old password</p>
						<div class="my-4">
							<label class="form-label">New Password </label>
							<input name="new_password" id="new_password" type="text" class="form-control" placeholder="Type New Password Here" />
						</div>
						<div class="my-4">
							<label class="form-label">Confirm Password </label>
							<input name="confirm_password" type="text" class="form-control" placeholder="Type Confirm Password" />
						</div>
						<div class="d-grid gap-2">
							{{@csrf_field()}}
							<button type="submit" id="btn3" style="height:45px;" class="btn btn-primary">Submit</button>
							 <a href="{{url('/admin')}}" class="btn btn-light"><i class='bx bx-arrow-back me-1'></i>Back to Login</a>
						</div>
					</div>
				</div>
			</form>
			</div>
		</div>
	</div>
	<!-- end wrapper -->
	<script src="{{url('project-js/jquery.js')}}"></script>
        <script src="{{url('project-js/validation.js')}}"></script>
        <script src="{{url('project-js/sweetalert.js')}}"></script>
        <script src="{{url('project-js/admin/login.js')}}"></script>
</body>


<!-- Mirrored from codervent.com/syndron/demo/vertical/auth-basic-forgot-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 08 Jun 2023 07:09:54 GMT -->
</html>