$("#customer_login").validate({
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
            url: "/user-login",
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
                        window.location = "/customer/dashboard";
                    }, 2000);
                }
            },
            error: function () {
                $("#btn").attr("disabled", false);
                $("#btn").html("Sign in");
                Command: toastr["error"]("Error", "Technical Issue");
            },
        });
    },
});
