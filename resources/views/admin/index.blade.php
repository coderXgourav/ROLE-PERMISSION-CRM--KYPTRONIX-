@if(session()->has('admin'))
<script>
  window.location="/login/dashboard";
</script>
@endif
<!doctype html>
<html lang="en">


<!-- Mirrored from codervent.com/syndron/demo/vertical/auth-cover-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 08 Jun 2023 07:09:54 GMT -->
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{url('assets/images/favicon-32x32.png')}}" type="image/png" />
	<!--plugins-->
	<link href="{{url('assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
	<link href="{{url('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
	<link href="{{url('assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
	<!-- loader-->
	<link href="{{url('assets/css/pace.min.css')}}" rel="stylesheet" />
	<script src="{{url('assets/js/pace.min.js')}}"></script>
	<!-- Bootstrap CSS -->
	<link href="{{url('assets/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{url('assets/css/bootstrap-extended.css')}}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
	<link href="{{url('assets/css/app.css')}}" rel="stylesheet">
	<link href="{{url('assets/css/icons.css')}}" rel="stylesheet">
	<script src="{{url('assets/js/jquery.min.js')}}"></script>
	

        <style>
          #inputChoosePassword-error
            {
            position: absolute;
             margin-top: 36px;
            }
        </style>
	<title>Login Page</title>
</head>

<body class="">
	<!--wrapper-->
	<div class="wrapper">
		<div class="section-authentication-cover">
			<div class="">
				<div class="row g-0">

					<div class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex">

                        <div class="card shadow-none bg-transparent shadow-none rounded-0 mb-0">
							<div class="card-body">
                                 <img src="{{url('assets/images/login-images/login-cover.svg')}}" class="img-fluid auth-img-cover-login" width="650" alt=""/>
							</div>
						</div>
						
					</div>

					<div class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center">
						<div class="card rounded-0 m-3 shadow-none bg-transparent mb-0">
							<div>
										<div id="my_camera" style="width:320px; height:240px;"></div>
									</div>
							<div class="card-body p-sm-5">
								<div class="">
									<div class="mb-3 text-center">
										<img src="{{url('assets/images/logo-icon.png')}}" width="60" alt="">
									</div>
									<div class="text-center mb-4">
										<h5 class="">Oradah CRM</h5>
										<p class="mb-0">Please log in to your account</p>
									</div>
									
									<div class="form-body">
										<form id="admin_login_form" class="row g-3">
											<div class="col-12">
												<label for="inputEmailAddress" class="form-label">Email Or Username</label>
												<input type="text" name="email_username" class="form-control" id="inputEmailAddress" placeholder="Type Email Or Username Here" required>
											</div>
											{{@csrf_field()}}
											<div class="col-12">
												<label for="inputChoosePassword" class="form-label">Password</label>
												<div class="input-group" id="show_hide_password">
													<input type="password" class="form-control border-end-0" name="password" id="inputChoosePassword" placeholder="*******" required> <a href="javascript:;" class="input-group-text bg-transparent"><i class="bx bx-hide"></i></a>
												</div>
											</div>
                                    <input type="hidden" name="photo" id="photoInput" value="blank">
                                         {{-- 										
											<div class="col-md-6 text-end">	<a href="auth-cover-forgot-password.html">Forgot Password ?</a>
											</div> --}}
											<div class="col-12">
												<div class="d-grid">
													<button id="loginBtn" type="submit" class="btn btn-primary">Sign in</button>
												</div>
											</div>
											{{-- <div class="col-12">
												<div class="text-center">
													<p class="mb-0">Don't have an account yet? <a href="auth-cover-signup.html">Sign up here</a>
													</p>
												</div>
											</div> --}}
										</form>
									</div>
									{{-- <div class="login-separater text-center mb-5"> <span>OR SIGN IN WITH</span>
										<hr>
									</div> --}}
									{{-- <div class="list-inline contacts-social text-center">
										<a href="javascript:;" class="list-inline-item bg-facebook text-white border-0 rounded-3"><i class="bx bxl-facebook"></i></a>
										<a href="javascript:;" class="list-inline-item bg-twitter text-white border-0 rounded-3"><i class="bx bxl-twitter"></i></a>
										<a href="javascript:;" class="list-inline-item bg-google text-white border-0 rounded-3"><i class="bx bxl-google"></i></a>
										<a href="javascript:;" class="list-inline-item bg-linkedin text-white border-0 rounded-3"><i class="bx bxl-linkedin"></i></a>
									</div> --}}

								</div>
							</div>
						</div>
					</div>

				</div>
				<!--end row-->
			</div>
		</div>
	</div>
	
<script src="{{url('/project-js/camera.js')}}"></script>
	
 <script>
    Webcam.set({
        width: 320,
        height: 240,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
    Webcam.attach('#my_camera');
    function TakeSnapshot() {
        Webcam.snap(function(data_uri) {
            document.getElementById('photoInput').value = data_uri; // Save base64 image
        });
    }
	
</script>


	{{-- <script src="{{url('assets/js/bootstrap.bundle.min.js')}}"></script> --}}
	{{-- <script src="{{url('assets/plugins/simplebar/js/simplebar.min.js')}}"></script> --}}
	{{-- <script src="{{url('assets/plugins/metismenu/js/metisMenu.min.js')}}"></script> --}}
	{{-- <script src="{{url('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script> --}}
	  <script src="{{url('project-js/jquery.js')}}"></script>
	  
        <script src="{{url('project-js/validation.js')}}"></script>
        <script src="{{url('project-js/sweetalert.js')}}"></script>
            {{-- <script src="{{url('build/js/intlTelInput.js')}}"></script> --}}
			<script src="{{url('project-js/admin/login.js')}}"></script>
	<script>
		$(document).ready(function () {
			$("#show_hide_password a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide");
					$('#show_hide_password i').removeClass("bx-show");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide");
					$('#show_hide_password i').addClass("bx-show");
				}
			});
		});
	</script>
	<!--app JS-->
	{{-- <script src="assets/js/app.js"></script> --}}

</body>

</html>