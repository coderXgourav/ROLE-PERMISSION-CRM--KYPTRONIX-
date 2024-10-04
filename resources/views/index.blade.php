<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<!-- Mirrored from lion-coders.com/demo/html/sarchholm-real-estate-template/home-v4.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 15 Jun 2023 11:31:03 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <!-- Metas -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="LionCoders" />
    <!-- Links -->
    <link rel="icon" type="image/png" href="#" />
    <!-- google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;display=swap" rel="stylesheet" />
    <!-- Plugins CSS -->
    <link href="{{ url('css/plugin.css') }}" rel="stylesheet" />
    <!-- style CSS -->
    <link href="{{ url('css/style.css') }}" rel="stylesheet" />
    {{-- NUMBER  --}}
    <link rel="stylesheet" href="{{ url('build/css/intlTelInput.css') }}" />
    <link rel="stylesheet" href="{{ url('build/css/demo.css') }}" />
    {{-- NUMBER  --}}
    <style>
        @media only screen and (max-width: 815px) {
            .hero__form.v3 {
                padding: 45px !important;
            }

            .header-text.v2 {
                margin-bottom: -66px !important;
                padding: 28px !important;
            }
        }

        /* .iti__selected-flag{
 pointer-events: none;
    cursor: default;
    text-decoration: none;
}
.iti__arrow{
 display: none;
} */
        .error {
            color: red !important;
        }
    </style>

    <!-- Document Title -->
    <title>Home Page</title>
</head>

<body>
    <!--Page Wrapper starts-->
    <div class="page-wrapper">
        <!--header starts-->
        <header class="header transparent scroll-hide">
            <!--Main Menu starts-->
            <div class="site-navbar-wrap v1">
                <div class="container">
                    <div class="site-navbar">
                        <div class="row align-items-center">
                            <div class="col-lg-2 col-md-6 col-9 order-2 order-xl-1 order-lg-1 order-md-1">
                                <a class="navbar-brand" href="index.html"><img src="images/logo-white.png"
                                        alt="logo" class="img-fluid" /></a>
                            </div>
                            <div class="col-lg-6 col-md-1 col-3 order-3 order-xl-2 order-lg-2 order-md-3 pl-xs-0">

                            </div>
                        </div>
                    </div>
                </div>
                <!--Main Menu ends-->
        </header>
        <!--Header ends-->
        <!--Hero section starts-->
        <div class="hero-parallax bg-fixed"
            style="background-image: url(https://modern.b-cdn.net/wp-content/uploads/2017/06/slide-two.jpg)">
            <div class="overlay op-1"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="hero-slider-item">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-12 col-12">
                                    <div class="header-text v2">
                                        <span>Click or call we do it all </span>
                                        <h1>Find Properties that make you money</h1>
                                        <!-- <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Eligendi quia fugiat ea adipisci earum
                        repudiandae, corporis culpa esse distinctio
                        consequuntur?
                      </p> -->
                                    </div>
                                </div>
                                <div class="col-xl-4 offset-xl-2 col-lg-5 offset-lg-1 col-md-12">
                                    <div class="hero-slider-info">
                                        <form class="hero__form v3 filter listing-filter" id="user_details_form">

                                            <h4><b>Let Us Call You!</b></h4>
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <div>
                               

                                                      <select name="service"  class="form-control">
                                                        <option value="">Select Service</option>
                                                        @foreach ($service as $item)
                                                        <option value="{{$item->service_id}}">{{$item->name}}</option>
                                                            
                                                        @endforeach
                                                      </select>

                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <div>
                                                        <input type="text" name="name" class="form-control"
                                                            placeholder="Type Your Name" required />
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <div class="input-man">
                                                        <input type="tel" id="phone" class="form-control"
                                                            name="phone" placeholder="Type Your Mobile Number"
                                                            required style="width: 387px; height: 45px;">

                                                        <input type="hidden" id="country_code" name="country_code"
                                                            value="">



                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <div class="input-man">
                                                        <input type="text" name="email" class="form-control"
                                                            id="place-event" placeholder="Type Email Here" required />
                                                    </div>
                                                </div>
                                                {{ @csrf_field() }}
                                                <div class="col-md-12 mb-3">
                                                    <!-- <input type="text" class="form-control"> -->
                                                    <textarea name="msg" id="" cols="30" rows="3" placeholder="Type Message Here.."
                                                        class="form-control" required></textarea>
                                                </div>

                                                <div class="col-sm-12">
                                                    <div class="search_btn">
                                                        <button type="submit" id="btn"
                                                            onclick="FormSubmit()">Submit
                                                        </button>

                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    </div>
    </div>
    </div>



    <!--login Modal ends-->
    <!--Scripts starts-->
    <!--plugin js-->
    <script src="{{ url('js/plugin.js') }}"></script>

    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_8C7p0Ws2gUu7wo0b6pK9Qu7LuzX2iWY&amp;libraries=places&amp;callback=initAutocomplete">
    </script>

    <script src="{{ url('js/main.js') }}"></script>

    <script src="{{ url('project-js/jquery.js') }}"></script>
    <script src="{{ url('project-js/validation.js') }}"></script>
    <script src="{{ url('project-js/sweetalert.js') }}"></script>
    <script src="{{ url('build/js/intlTelInput.js') }}"></script>


    <script>
        var input = document.querySelector("#phone");
        window.intlTelInput(input, {
            utilsScript: "build/js/utils.js"
        });
    </script>

    <script>
        function FormSubmit() {
            var countryCodeTitle = $('.iti__selected-flag').attr('title');
            var countryCode = countryCodeTitle.match(/\+\d+/)[0];
            $('#country_code').val(countryCode);

            $('#user_details_form').validate({
                rules: {
                    name: "required",
                    phone: {
                        required: true,
                        maxlength: 20,
                        minlength: 7,
                    },
                    email: {
                        required: true,
                    },
                    msg: {
                        required: true,
                        maxlength: 200
                    },
                },
                messages: {

                },
                submitHandler: function(form, event) {
                    event.preventDefault();
                    $("#btn").html('Please Wait');
                    $("#btn").attr("disabled", true);
                    $.ajax({
                        url: "/request",
                        method: "POST",
                        dataType: "JSON",
                        data: new FormData(form),
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            swal.fire({
                                icon: data.icon,
                                title: data.title,
                            });
                            $("#btn").attr("disabled", false);
                            $("#btn").html("Submit");
                            if (data.status) {
                                $("#user_details_form").trigger("reset");
                            }
                        },
                    });
                },

            });
        }
    </script>

</body>

</html>
