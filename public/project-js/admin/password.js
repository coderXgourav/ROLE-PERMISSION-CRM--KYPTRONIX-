// change_password function
$("#change_password_form").validate({
    rules: {
        old: {
            required: true,
            minlength: 3,
            maxlength: 30,
        },
        new: {
            required: true,
            minlength: 3,
            maxlength: 30,
        },
        confirm: {
            required: true,
            minlength: 3,
            maxlength: 30,
            equalTo: "#password",
        },
    },
    messages: {},
    submitHandler: function (form, event) {
        event.preventDefault();
        $("#MyBtn").html(
            "<button class='btn btn-primary' type='button' disabled> <span class='spinner-border spinner-border-sm ' role='status' aria-hidden='true'></span></button>"
        );
        $("#MyBtn").attr("disabled", true);
        $.ajax({
            url: "/admin/change_password",
            method: "POST",
            data: new FormData(form),
            dataType: "JSON",
            contentType: false,
            processData: false,
            success: function (data) {
                $("#MyBtn").html("Change Password");
                $("#MyBtn").attr("disabled", false);
                Command: toastr[data.icon](data.title, data.msg);
                if (data.status) {
                    $("#change_password_form").trigger("reset");
                }
            },
        });
    },
});
// change_password function

// THIS IS CHANGE USERNAME FUNCTION

$("#change_username_form").validate({
    rules: {
        new_email: {
            email: true,
        },
    },
    messages: {},
    submitHandler: function (form, event) {
        event.preventDefault();
        $("#btn").html(
            "<button class='btn btn-primary' type='button' disabled> <span class='spinner-border spinner-border-sm ' role='status' aria-hidden='true'></span></button>"
        );
        $("#btn").attr("disabled", true);
        $.ajax({
            url: "/admin/change_username",
            method: "POST",
            data: new FormData(form),
            dataType: "JSON",
            contentType: false,
            processData: false,
            success: function (data) {
                $("#btn").html("Update");
                $("#btn").attr("disabled", false);
                Command: toastr[data.icon](data.title, data.msg);
                if (data.status) {
                    $("#change_username_form").trigger("reset");
                }
            },
        });
    },
});
// THIS IS CHANGE USERNAME FUNCTION
