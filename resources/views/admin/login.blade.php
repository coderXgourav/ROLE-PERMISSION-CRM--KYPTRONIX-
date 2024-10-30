@if(session()->has('admin'))
<script>
  window.location="/login/dashboard";
</script>
@endif
<!DOCTYPE html>
<html lang="en">
    <!-- Mirrored from codervent.com/syndron/demo/vertical/auth-basic-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 08 Jun 2023 07:09:54 GMT -->
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!--favicon-->
        <link
            rel="icon"
            href="{{url('assets/images/favicon-32x32.png')}}"
            type="image/png"
        />
        <!--plugins--> 
        <link
            href="{{url('assets/plugins/simplebar/css/simplebar.css')}}"
            rel="stylesheet"
        />

        <link
            href="{{url('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}"
            rel="stylesheet"
        />
        <link
            href="{{url('assets/plugins/metismenu/css/metisMenu.min.css')}}"
            rel="stylesheet"
        />
        <!-- loader-->
        
        <link href="{{url('assets/css/pace.min.css')}}" rel="stylesheet" />
        <script src="{{url('assets/js/pace.min.js')}}"></script>
        <!-- Bootstrap CSS -->
        <link href=" {{url('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
        <link href="{{url('assets/css/bootstrap-extended.css')}}" rel="stylesheet" />
        <link
            href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap"
            rel="stylesheet"
        />
        <link href="assets/css/app.css" rel="stylesheet" />
        <link href="assets/css/icons.css" rel="stylesheet" />
        <title>CRM</title>
        <style>
            #password-error
            {
            position: absolute;
             margin-top: 40px;
            }
        </style>
    </head>

    <body class="">
        <!--wrapper-->
        <div class="wrapper">
            <div
                class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0"
            >
                <div class="container">
                    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                        <div class="col mx-auto">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <div class="p-4">
                                        <div class="mb-3 text-center">
                                            {{-- <img
                                               src="{{url('assets/images/logo-icon.png')}}"
                                                width="60"
                                                alt=""
                                            /> --}}
                                            <img src="{{url('gifs/login.gif')}}" style="width:130px;"></img>
                                        </div>
                                        <div class="text-center mb-4">
                                            <h5 class=""> Admin Login </h5>
                                            <p class="mb-0">
                                                Please log in to your account
                                            </p>
                                        </div>
                                        <div class="form-body">
                                            <form class="row g-3" id="admin_login_form">
                                                <div class="col-12">
                                                    <label
                                                        for="inputEmailAddress"
                                                        class="form-label"
                                                        >Email Or Username</label
                                                    >
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="inputEmailAddress"
                                                        name="username"
                                                        placeholder="Type Email Or Username Here"
                                                    />
                                                    {{@csrf_field()}}
                                                </div>
                                                <div class="col-12">
                                                    <label
                                                        for="inputChoosePassword"
                                                        class="form-label"
                                                        >Password</label
                                                    >
                                                    <div
                                                        class="input-group"
                                                    >
                                                        <input
                                                            type="password" id="password"
                                                            class="form-control border-end-0"
                                                             name="password"
                                                            placeholder="**********"
                                                        />
                                                        <a
                                                            href="javascript:void(0)"
                                                            class="input-group-text bg-transparent"
                                                            onclick="ShowHide()"
                                                            ><i id="showBtn"
                                                                class="bx bx-hide"
                                                            ></i
                                                        ></a>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div
                                                        class="form-check form-switch"
                                                    >
                                              
                                                    </div>
                                                </div>
                                                <div class="col-md-6 text-end">
                                                    <a
                                                        href="{{url('admin/forgot-password')}}"
                                                        >Forgot Password ?</a
                                                    >
                                                </div>
                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <button
                                                        style='height:45px'
                                                        id="loginBtn"
                                                            type="submit"
                                                            class="btn btn-primary"
                                                        >
                                                            Sign in
                                                        </button>
                                                    </div>
                                                </div>
                                              
                                            </form>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </div>
        </div>
        <!--end wrapper-->
        <!-- Bootstrap JS --> 
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
        <script src="{{url('project-js/admin/login.js')}}"></script>
        <script>
    
        </script>
        <script>
            function ShowHide(){
               let a = $('#password').attr('type');
              if(a == "password"){
           $('#password').attr('type','text');
           $('#showBtn').removeClass('bx-hide');
           $('#showBtn').addClass('bx-show');
              }else{
           $('#password').attr('type','password');
           $('#showBtn').removeClass('bx-show');
            $('#showBtn').addClass('bx-hide');

              }
            
            }
     
        </script>
       
    </body>


</html>

