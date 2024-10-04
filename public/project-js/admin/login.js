$("#admin_login_form").validate({
    rules: {
        username: "required",
        password: {
            required: true,
            maxlength: 50,
        },
    },
    messages: {
        username: "Please Enter Your Username Or Email",
        password: {
            required: "Please Enter Password",
            maxlength: 50,
        },
    },
    submitHandler: function (form, event) {
        event.preventDefault();
        $("#loginBtn").html(
            "<button class='btn btn-primary' type='button' disabled> <span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span><span class='visually-hidden'>Loading...</span></button>"
        );
        $("#loginBtn").attr("disabled", true);
        $.ajax({
            url: "/admin-login",
            method: "POST",
            dataType: "JSON",
            data: new FormData(form),
            contentType: false,
            processData: false,
            success: function (data) {
                $("#loginBtn").attr("disabled", false);
                $("#loginBtn").html("Sign in");
                swal.fire({
                    title: data.title,
                    icon: data.icon,
                });
                if (data.status) {
                    setTimeout(() => {
                        window.location = "/admin/dashboard";
                    }, 2000);
                }
            },
        });
    },
});

// THIS IS FORGOT FUNCTION
$("#forget_password").validate({
    rules: {
        email: {
            required: true,
            email: true,
        },
    },
    messages: {},
    submitHandler: function (form, event) {
        event.preventDefault();
        $("#btn").html(
            "<button class='btn btn-primary' type='button' disabled> <span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span><span class='visually-hidden'>Loading...</span></button>"
        );
        $("#btn").attr("disabled", true);
        $.ajax({
            url: "/admin/reset_password",
            method: "POST",
            dataType: "JSON",
            data: new FormData(form),
            contentType: false,
            processData: false,
            success: function (data) {
                $("#btn").attr("disabled", false);
                $("#btn").html("Send");
                Command: toastr[data.icon](data.title, data.msg);
                if (data.status) {
                    $("#forget_password").hide();
                    $("#otp_form").show();
                }
            },
        });
    },
});

// THIS IS OTP FUNCTION

// THIS IS FORGOT FUNCTION
$("#otp_form").validate({
    rules: {
        otp: {
            required: true,
            number: true,
            minlength: 4,
            maxlength: 4,
        },
    },
    messages: {},
    submitHandler: function (form, event) {
        event.preventDefault();
        $("#btn2").html(
            "<button class='btn btn-primary' type='button' disabled> <span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span><span class='visually-hidden'>Loading...</span></button>"
        );
        $("#btn2").attr("disabled", true);
        $.ajax({
            url: "/admin/otp_check",
            method: "POST",
            dataType: "JSON",
            data: new FormData(form),
            contentType: false,
            processData: false,
            success: function (data) {
                $("#btn2").attr("disabled", false);
                $("#btn2").html("Submit");
                Command: toastr[data.icon](data.title, data.msg);
                if (data.status) {
                    $("#otp_form").hide();
                    $("#new_password_form").show();
                }
            },
        });
    },
});

// THIS IS CHANGE_PASSWORD FUNCTION

$("#new_password_form").validate({
    rules: {
        new_password: {
            required: true,
            minlength: 4,
            maxlength: 30,
        },
        confirm_password: {
            required: true,
            minlength: 4,
            maxlength: 30,
            equalTo: "#new_password",
        },
    },
    messages: {},
    submitHandler: function (form, event) {
        event.preventDefault();
        $("#btn3").html(
            "<button class='btn btn-primary' type='button' disabled> <span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span><span class='visually-hidden'>Loading...</span></button>"
        );
        $("#btn3").attr("disabled", true);
        $.ajax({
            url: "/admin/new_password",
            method: "POST",
            dataType: "JSON",
            data: new FormData(form),
            contentType: false,
            processData: false,
            success: function (data) {
                $("#btn3").attr("disabled", false);
                $("#btn3").html("Submit");
                swal.fire({
                    icon: data.icon,
                    title: data.title,
                });
                if (data.status) {
                    $("#new_password_form").trigger("reset");
                }
            },
        });
    },
});
