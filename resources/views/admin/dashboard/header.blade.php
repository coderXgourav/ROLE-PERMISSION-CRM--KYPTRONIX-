<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from codervent.com/syndron/demo/vertical/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 08 Jun 2023 07:08:40 GMT -->

<head>
    <!-- Required meta tags -->
    <style>
        .w-5{
            display: none;
        }
        .h-5{
            display: none;
        }
        .leading-5{
            padding: 10px;
        }
       .z-0{
        display: none;
       }
        
    </style>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--favicon-->
    <link rel="icon" href="{{ url('assets/images/favicon-32x32.png') }}" type="image/png" />
    <!--plugins-->
    <link href="{{ url('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    
    <!-- loader-->

    <link href="{{ url('assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ url('assets/js/pace.min.js') }}"></script>

    <!-- Bootstrap CSS -->
    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/css/bootstrap-extended.css') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet" />
    <link href="{{ url('assets/css/app.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/css/icons.css') }}" rel="stylesheet" />

    <!-- Theme Style CSS -->

    <link rel="stylesheet" href="{{ url('assets/css/dark-theme.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/css/semi-dark.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/css/header-colors.css') }}" />
    {{-- NUMBER  --}}
    <link rel="stylesheet" href="{{ url('build/css/intlTelInput.css') }}" />
    <link rel="stylesheet" href="{{ url('build/css/demo.css') }}" />
    {{-- NUMBER  --}}

    {{-- TOASTR  --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="{{ url('project-js/alert_show.js') }}"></script>

    {{-- TOASTR  --}}


    @stack('title')
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        <div class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div>
                    <img src="{{ url('assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon" />
                </div>
                <div>
                    <h4 class="logo-text"> {{"Dashboard"}}</h4>
                </div>
                <div class="toggle-icon ms-auto">
                    <i class="bx bx-arrow-back"></i>
                </div>
            </div>
            <!--navigation-->
            <ul class="metismenu" id="menu">
                <li id="dashboard">
                    <a href="{{ route('admin-dashboard') }}">
                        <div class="parent-icon">
                            <i class="bx bx-home-alt"></i>
                        </div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                </li>
                @if( $admin_data->service_add>0 || $admin_data->service_view>0)
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-category"></i>
                        </div>
                        <div class="menu-title">Service </div>
                    </a>
                    <ul>
                         @if($admin_data->service_add>0)
                        <li> <a href="{{ route('admin.add-service')}}"><i
                                    class='bx bx-radio-circle'></i>Add New Service</a>
                        </li>
                        @endif
                           @if($admin_data->service_view>0)
                        <li> <a href="{{ route('admin.all-service')}}"><i
                                    class='bx bx-radio-circle'></i>Services</a>
                        </li>
                        @endif
                      
                    </ul>
                </li>
                @endif
                
                 @if($admin_data->user_type=="admin")
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-category"></i>
                        </div>
                        <div class="menu-title">Role </div>
                    </a>
                    <ul>
                        <li> <a href="{{ route('admin.add-role')}}"><i
                                    class='bx bx-radio-circle'></i>Add Role</a>
                        </li> 
                        <li> <a href="{{ route('admin.all-role')}}"><i
                                    class='bx bx-radio-circle'></i> View Roles</a>
                        </li>
                      
                    </ul>
                </li>
                @endif
    
                
               
            @if($admin_data->staff_registration>0 || $admin_data->staff_view>0)
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-user-circle"></i>
                        </div>
                        <div class="menu-title">Staff</div>
                    </a>
                    <ul>
                           @if($admin_data->staff_registration>0)
                        <li> <a href="{{ route('admin.add-contact') }}"><i
                                    class='bx bx-radio-circle'></i>Registration</a>
                        </li>
                        @endif
                           @if($admin_data->staff_view>0)

                        <li> <a href="{{ route('admin.contact') }}"><i
                                    class='bx bx-radio-circle'></i>View Staffs</a>
                        </li>
                        @endif
                      
                    </ul>
                </li>
                @endif
            @if($admin_data->package_add>0 || $admin_data->package_view >0)


                 <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-category"></i>
                        </div>
                        <div class="menu-title">Package </div>
                    </a>
                    <ul>
                          @if($admin_data->package_add>0)
                        <li> <a href="{{ route('admin.add-package')}}"><i
                                    class='bx bx-radio-circle'></i>Add New Package</a>
                        </li>
                        @endif
                          @if($admin_data->package_view>0)

                        <li> <a href="{{ route('admin.all-package')}}"><i
                                    class='bx bx-radio-circle'></i>Packages</a>
                        </li>
                        @endif
                      
                    </ul>
                </li>
                @endif
                        
                 @if($admin_data->report_count>0 || $admin_data->report_staff>0 || $admin_data->report_individual>0 || $admin_data->report_business>0)
                    <li>
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon"><i class="bx bx-book"></i>
                            </div>
                            <div class="menu-title">Reports</div>
                        </a>
                        <ul>
                         @if($admin_data->report_count>0)
                            <li> <a href="{{route('admin.all-reports')}}"><i
                                class='bx bx-radio-circle'></i>Count Report</a>
                            </li>
                        @endif
                         @if($admin_data->report_staff>0)

                           <li> <a href="{{route('admin.staff-report')}}"><i
                                class='bx bx-radio-circle'></i>Staff Report</a>
                            </li>
                        @endif
                         @if($admin_data->report_individual>0)

                             <li> <a href="{{route('admin.individual-report')}}"><i
                                class='bx bx-radio-circle'></i>Individual Report</a>
                            </li>
                        @endif
                         @if($admin_data->report_business>0)

                              <li> <a href="{{route('admin.business-report')}}"><i
                                class='bx bx-radio-circle'></i>Business Report</a>
                            </li>
                           @endif 
                        </ul>
                    </li>
                    @endif

                    @if($admin_data->leads_import_individual>0 || $admin_data->leads_import_business>0)

                    <li>
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon"><i class="bx bx-folder"></i>
                            </div>
                            <div class="menu-title">Import Leads</div>
                        </a>
                        <ul>
                      @if($admin_data->leads_import_individual>0 || $admin_data->leads_import_business>0)
                            <li> <a href="{{route('admin.import-leads')}}"><i
                                class='bx bx-radio-circle'></i>
                                Show Import Leads</a>
                           </li>
                        @endif
                        </ul>
                    </li>
                    @endif

                   @if($admin_data->leads_add>0 || $admin_data->leads_view> 0)
                    <li>
                       <a href="javascript:;" class="has-arrow">
                          <div class="parent-icon"><i class='bx bx-cart'></i>
                           </div>
                           <div class="menu-title">Leads  </div>
                       </a>
                       <ul>
                      @if($admin_data->leads_add > 0)
                            <li> <a href="{{ route('admin.add-lead')}}"><i
                                class='bx bx-radio-circle'></i>Add Leads</a>
                           </li>
                      @endif
                      @if($admin_data->leads_view > 0)
                            <li> <a href="{{ route('admin.view-lead')}}"><i class='bx bx-radio-circle'></i>View Leads</a>
                            </li>
                      @endif
                                                
                       </ul>
                   </li>
                   @endif
                  @if($admin_data->clients_view>0)
                    <li>
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon"><i class="bx bx-user-circle"></i>
                            </div>
                            <div class="menu-title">Clients </div>
                        </a>
                        <ul>                    
                            <li> <a href="{{route('admin.view_clients')}}"><i class='bx bx-radio-circle'></i>View Clients</a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    @if($admin_data->assign_manage>0)

                    <li>
                        <a href="javascript:;" class="has-arrow">
                         <div class="parent-icon"><i class='bx bx-menu'></i>
                         </div>
                         <div class="menu-title">Assign Manage </div>
                       </a>
                     <ul>
                        <li> <a href="{{ route('admin.assign') }}"><i
                            class='bx bx-radio-circle'></i>Assigned Leads</a>
                       </li>
                       <li> <a href="{{route('admin.noneassign')}}"><i class='bx bx-radio-circle'></i>None Assigned Leads</a>
                      </li>
                      
                    </ul>
                  </li>
                  @endif
  
                @if($admin_data->invoice_view>0)
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-square"></i>
                        </div>
                        <div class="menu-title">Invoice </div>
                    </a>
                    <ul>
                       <li> <a href="{{route('admin.view-invoice')}}"><i
                            class='bx bx-radio-circle'></i>View Invoice</a>
                       </li>  

                    </ul>
                </li>
                @endif
                    
                @if($admin_data->email_view>0 || $admin_data->sms_view>0)
                      <li>
                        <a href="javascript:" class="has-arrow">
                            <div class="parent-icon"><i class="bx bx-repeat"></i>
                            </div>
                            <div class="menu-title">Email & SMS</div>
                        </a>
                        <ul>
                            @if( $admin_data->email_view >0)
                            <li> <a href="{{ route('admin.email') }}"><i
                                class='bx bx-radio-circle'></i>
                                Sent Emails</a>
                           </li>
                           @endif
                            @if( $admin_data->sms_view >0)

                            <li> <a href="{{ route('admin.sms') }}"><i class='bx bx-radio-circle'></i> Sent SMS</a>
                            </li>
                            @endif
                        </ul>
                    </li>
                    @endif
                @if($admin_data->payments_successful>0 || $admin_data->payments_failed>0)

                    <li>
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon"><i class="bx bx-folder"></i>
                            </div>
                            <div class="menu-title">Payments</div>
                        </a>
                        <ul>
                         @if($admin_data->payments_successful>0 )
                            <li> <a href="{{route('admin.success-payments')}}"><i
                                class='bx bx-radio-circle'></i>
                                Successfull Payments</a>
                           </li>
                           @endif
                         @if($admin_data->payments_failed>0 )
                           <li> <a href="{{route('admin.failed-payments')}}"><i
                            class='bx bx-radio-circle'></i>
                            Failed Payments</a>
                       </li>
                       @endif
                            
                        </ul>
                    </li>
                    
                    @endif

                   @if($admin_data->login_history_view>0)
                    <li>
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon"><i class="bx bx-category"></i>
                            </div>
                            <div class="menu-title">Login History</div>
                        </a>
                        <ul>
                            <li> <a href="{{route('admin.loginHistory')}}"><i
                                class='bx bx-radio-circle'></i>
                                View History</a>
                           </li>
                        </ul>
                    </li>
                    @endif
                    


                    <li>
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon"><i
                                class="bx bx-cog fs-5"></i>
                            </div>
                            <div class="menu-title">Setting</div>
                        </a>
                        <ul>
                            <li> <a href="{{ route('change-password') }}"><i
                                class='bx bx-radio-circle'></i>
                                Change Password</a>
                           </li>
                            <li> <a href="{{ route('admin.change_username') }}"><i
                                        class='bx bx-radio-circle'></i>
                                        Update Credentials</a>
                            </li>
                           
                            <li> <a href="{{ route('admin-logout') }}"><i
                                        class='bx bx-radio-circle'></i>Logout</a>
                            </li>  
                            
                        </ul>
                    </li>
             
          
            </ul>
         
        </div>
     
        <header>
            <div class="topbar d-flex align-items-center">
                <nav class="navbar navbar-expand gap-3">
                    <a href="{{ url()->previous() }}" class="btn btn-danger">Back</a>
                    <div class="mobile-toggle-menu">
                        <i class="bx bx-menu"></i>
                    </div>

                    <div class="position-relative search-bar d-lg-block d-none" data-bs-toggle="modal"
                        data-bs-target="#SearchModal">
                        <input class="form-control px-5" disabled type="search" placeholder="Search"
                            style="display:none;" />
                    
                    </div>

                    <div class="top-menu ms-auto">
                        <ul class="navbar-nav align-items-center gap-1">
                            <li class="nav-item mobile-search-icon d-flex d-lg-none" data-bs-toggle="modal"
                                data-bs-target="#SearchModal">
                                <a class="nav-link" href="avascript:;"><i class="bx bx-search"></i>
                                </a>
                            </li>

                            <li class="nav-item dark-mode d-none d-sm-flex">
                                <a class="nav-link dark-mode-icon" href="javascript:;"><i class="bx bx-moon"></i>
                                </a>
                            </li>

                            <li class="nav-item dropdown dropdown-app" style="display: none;">
                                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown"
                                    href="javascript:;"><i class="bx bx-grid-alt"></i></a>
                                <div class="dropdown-menu dropdown-menu-end p-0">
                                    <div class="app-container p-2 my-2">
                                        <div class="row gx-0 gy-2 row-cols-3 justify-content-center p-2">
                                            <div class="col">
                                                <a href="javascript:;">
                                                    <div class="app-box text-center">
                                                        <div class="app-icon">
                                                            <img src="assets/images/app/safari.png" width="30"
                                                                alt="" />
                                                        </div>
                                                        <div class="app-name">
                                                            <p class="mb-0 mt-1">
                                                                Safari
                                                            </p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <!--end row-->
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item dropdown dropdown-large" style="display:none;">
                                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative"
                                    href="#" data-bs-toggle="dropdown"><span class="alert-count">1</span>
                                    <i class="bx bx-bell"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="javascript:;">
                                        <div class="msg-header">
                                            <p class="msg-header-title">
                                                Notifications
                                            </p>
                                            <p class="msg-header-badge">
                                                1 New
                                            </p>
                                        </div>
                                    </a>
                                    <div class="header-notifications-list">

                                        <a class="dropdown-item" href="javascript:;">
                                            <div class="d-flex align-items-center">
                                                <div class="notify bg-light-danger text-danger">
                                                    Test
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="msg-name">
                                                        New Orders
                                                        <span class="msg-time float-end">2 min ago</span>
                                                    </h6>
                                                    <p class="msg-info">
                                                        You have recived new
                                                        orders
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <a href="javascript:;">
                                        <div class="text-center msg-footer">
                                            <button class="btn btn-primary w-100">
                                                View All Notifications
                                            </button>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li class="nav-item dropdown dropdown-large" style="display: none">
                                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative"
                                    href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="alert-count">8</span>
                                    <i class="bx bx-shopping-bag"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="javascript:;">
                                        <div class="msg-header">
                                            <p class="msg-header-title">
                                                My Cart
                                            </p>
                                            <p class="msg-header-badge">
                                                10 Items
                                            </p>
                                        </div>
                                    </a>
                                    <div class="header-message-list">


                                        <a class="dropdown-item" href="javascript:;">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="position-relative">
                                                    <div class="cart-product rounded-circle bg-light">
                                                        <img src="assets/images/products/09.png" class=""
                                                            alt="product image" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="cart-product-title mb-0">
                                                        Men White T-Shirt
                                                    </h6>
                                                    <p class="cart-product-price mb-0">
                                                        1 X $29.00
                                                    </p>
                                                </div>
                                                <div class="">
                                                    <p class="cart-price mb-0">
                                                        $250
                                                    </p>
                                                </div>
                                                <div class="cart-product-cancel">
                                                    <i class="bx bx-x"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <a href="javascript:;">
                                        <div class="text-center msg-footer">
                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                <h5 class="mb-0">Total</h5>
                                                <h5 class="mb-0 ms-auto">
                                                    $489.00
                                                </h5>
                                            </div>
                                            <button class="btn btn-primary w-100">
                                                Checkout
                                            </button>
                                        </div>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="user-box dropdown px-3">
                        <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret"
                            href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ url('assets/images/user.png') }}" class="user-img" alt="user avatar" />
                            <div class="user-info">
                                <p class="user-name mb-0">{{ $admin_data->first_name }}</p>
                                <p class="designattion mb-0">
                                    {{$admin_data->modern_name}}
                                </p>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item d-flex align-items-center"
                                    href="{{ route('admin.change_username') }}"><i
                                        class="bx bx-user fs-5"></i><span>Update Profile</span></a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center"
                                    href="{{ route('change-password') }}"><i class="bx bx-cog fs-5"></i><span>Change
                                        Password</span></a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center"
                                    href="{{ route('admin-dashboard') }}"><i
                                        class="bx bx-home-circle fs-5"></i><span>Dashboard</span></a>
                            </li>
                       
                            <li>
                                <div class="dropdown-divider mb-0"></div>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center"
                                    href="{{ route('admin-logout') }}"><i
                                        class="bx bx-log-out-circle"></i><span>Logout</span></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <!--end header -->
        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
