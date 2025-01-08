function addTeamMember() {
    // var countryCodeTitle = $(".iti__selected-flag").attr("title");
    // var countryCode = countryCodeTitle.match(/\+\d+/)[0];
    // $("#country_code").val(countryCode);
}
$("#add_contact_form").validate({
    rules: {
        service_id: "required",
        name: "required",
        phone: "required",
        email: {
            required: true,
            email: true,
        },
        dob: "required",
        pin: "required",
        password: {
            required: true,
            minlength: 4,
            maxlength: 30,
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
            url: "/admin/create_contact",
            method: "POST",
            dataType: "JSON",
            data: new FormData(form),
            contentType: false,
            processData: false,
            success: function (data) {
                $("#btn").attr("disabled", false);
                $("#btn").html("Submit");
                Command: toastr[data.icon](data.title, data.msg);
                if (data.status) {
                    $("#add_contact_form").trigger("reset");
                }
            },
            error: function () {
                $("#btn").attr("disabled", false);
                $("#btn").html("Submit");
                Command: toastr["error"]("Error", "Technical Issue");
            },
        });
    },
});

// THIS IS update_contact_form FUNCTION \

// function updateTeamMember() {
//     var countryCodeTitle = $(".iti__selected-flag").attr("title");
//     var countryCode = countryCodeTitle.match(/\+\d+/)[0];
//     $("#country_code").val(countryCode);
// }
$("#update_contact_form").validate({
    rules: {
        name: "required",
        phone: "required",
        email: {
            required: true,
            email: true,
        },
        dob: "required",
        pin: "required",
        password: {
            required: true,
            minlength: 4,
            maxlength: 30,
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
            url: "/admin/update_contact",
            method: "POST",
            dataType: "JSON",
            data: new FormData(form),
            contentType: false,
            processData: false,
            success: function (data) {
                $("#btn").attr("disabled", false);
                $("#btn").html("update");
                Command: toastr[data.icon](data.title, data.msg);
                if (data.status) {
                    // $("#update_contact_form").trigger("reset");
                }
            },
            error: function () {
                $("#btn").attr("disabled", false);
                $("#btn").html("update");
                Command: toastr["error"]("Error", "Technical Issue");
            },
        });
    },
});
// THIS IS update_contact_form FUNCTION

// THIS IS DeleteTeam FUNCTION

function DeleteTeam(id) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "team_delete",
                data: { id: id },
                dataType: "JSON",
                success: function (data) {
                    swal.fire({
                        icon: data.icon,
                        title: data.title,
                    });
                    if (data.status) {
                        $("#" + id).hide();
                    }
                },
                error: function () {
                    $("#btn").attr("disabled", false);
                    $("#btn").html("Submit");
                    Command: toastr["error"]("Error", "Technical Issue");
                },
            });
        }
    });
}

// THIS IS DeleteTeam FUNCTION

// THIS IS update_contact_form FUNCTION \
$("#assign_client_form").validate({
    rules: {
        team_member: {
            required: true,
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
            url: "/admin/assign",
            method: "POST",
            dataType: "JSON",
            data: new FormData(form),
            contentType: false,
            processData: false,
            success: function (data) {
                $("#btn").attr("disabled", false);
                $("#btn").html("Submit");
                swal.fire({
                    title: data.title,
                    icon: data.icon,
                });
                if (data.status) {
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }
            },
            error: function () {
                $("#btn").attr("disabled", false);
                $("#btn").html("Submit");
                Command: toastr["error"]("Error", "Technical Issue");
            },
        });
    },
});

$("#assign_lead_to_service").validate({
    rules: {
        team_member: {
            required: true,
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
            url: "/admin/assign_lead_to_service",
            method: "POST",
            dataType: "JSON",
            data: new FormData(form),
            contentType: false,
            processData: false,
            success: function (data) {
                $("#btn").attr("disabled", false);
                $("#btn").html("Submit");
                swal.fire({
                    title: data.title,
                    icon: data.icon,
                });
                if (data.status) {
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                }
            },
            error: function () {
                $("#btn").attr("disabled", false);
                $("#btn").html("Submit");
                Command: toastr["error"]("Error", "Technical Issue");
            },
        });
    },
});

// THIS IS update_contact_form FUNCTION

$("#update_assign_client_form").validate({
    rules: {
        team_member: {
            required: true,
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
            url: "/admin/update-assign",
            method: "POST",
            dataType: "JSON",
            data: new FormData(form),
            contentType: false,
            processData: false,
            success: function (data) {
                $("#btn").attr("disabled", false);
                $("#btn").html("Submit");
                swal.fire({
                    title: data.title,
                    icon: data.icon,
                });
                if (data.status) {
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                }
            },
            error: function () {
                $("#btn").attr("disabled", false);
                $("#btn").html("Submit");
                Command: toastr["error"]("Error", "Technical Issue");
            },
        });
    },
});

// THIS IS upload_clients FUNCTION
$("#upload_clients").validate({
    rules: {
        csv: "required",
    },
    messages: {},
    submitHandler: function (form, event) {
        event.preventDefault();
        $("#btn2").html(
            "<button class='btn btn-primary' type='button' disabled> <span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span><span class='visually-hidden'>Loading...</span></button>"
        );
        $("#btn2").attr("disabled", true);
        $.ajax({
            url: "/admin/upload_csv",
            method: "POST",
            dataType: "JSON",
            data: new FormData(form),
            contentType: false,
            enctype: "multipart/form-data",
            processData: false,
            success: function (data) {
                $("#btn2").attr("disabled", false);
                $("#btn2").html("Upload Business Leads");
                Command: toastr[data.icon](data.title, data.msg);
                if (data.status) {
                    $("#upload_clients").trigger("reset");
                }
            },
            error: function (xhr) {
                console.log(xhr);

                if (xhr.status == 500) {
                    $("#btn2").attr("disabled", false);
                    $("#btn2").html("Upload Business Leads");
                    Command: toastr["error"](
                        "Please Upload Formated Excel File ",
                        "Error"
                    );
                } else {
                    $("#btn2").attr("disabled", false);
                    $("#btn2").html("Upload Business Leads");
                    $.each(xhr.responseJSON.errors, function (field, messages) {
                        // Join all the error messages for a specific field (if there are multiple)
                        var message = messages.join(" ");

                        // Display the error message with Toastr
                        toastr["error"](message, "Error");
                    });
                }
            },
        });
    },
});

// THIS IS upload_clients FUNCTION

$("#upload_individual_lead").validate({
    rules: {
        csv: "required",
    },
    messages: {},
    submitHandler: function (form, event) {
        event.preventDefault();
        $("#btn1").html(
            "<button class='btn btn-primary' type='button' disabled> <span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span><span class='visually-hidden'>Loading...</span></button>"
        );
        $("#btn1").attr("disabled", true);
        $.ajax({
            url: "/admin/upload_individual_csv",
            method: "POST",
            dataType: "JSON",
            data: new FormData(form),
            contentType: false,
            enctype: "multipart/form-data",
            processData: false,
            success: function (data) {
                $("#btn1").attr("disabled", false);
                $("#btn1").html("Upload Individual Leads");
                Command: toastr[data.icon](data.title, data.msg);
                if (data.status) {
                    $("#upload_individual_lead").trigger("reset");
                }
            },
            error: function (xhr) {
                console.log(xhr);

                if (xhr.status == 500) {
                    $("#btn1").attr("disabled", false);
                    $("#btn1").html("Upload Individual Leads");
                    Command: toastr["error"](
                        "Please Upload Formated Excel File ",
                        "Error"
                    );
                } else {
                    $("#btn1").attr("disabled", false);
                    $("#btn1").html("Upload Individual Leads");
                    $.each(xhr.responseJSON.errors, function (field, messages) {
                        // Join all the error messages for a specific field (if there are multiple)
                        var message = messages.join(" ");

                        // Display the error message with Toastr
                        toastr["error"](message, "Error");
                    });
                }
            },
        });
    },
});

// THIS IS DeleteTeam FUNCTION

function DeleteCustomer(id) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "client_delete",
                method: "POST",
                data: { id: id },
                dataType: "JSON",
                success: function (data) {
                    Command: toastr[data.icon](data.title, data.msg);
                    if (data.status) {
                        $("#" + id).hide();
                    }
                },
                error: function () {
                    $("#btn").attr("disabled", false);
                    $("#btn").html("Submit");
                    Command: toastr["error"]("Error", "Technical Issue");
                },
            });
        }
    });
}

// THIS IS DeleteTeam FUNCTION
function addMembers() {
    var countryCodeTitle = $(".iti__selected-flag").attr("title");
    var countryCode = countryCodeTitle.match(/\+\d+/)[0];
    $("#country_code").val(countryCode);
}
$("#add_team_members_form").validate({
    rules: {
        service_id: "required",
        name: "required",
        phone: "required",
        email: {
            required: true,
            email: true,
        },
        dob: "required",
        pin: "required",
        password: {
            required: true,
            minlength: 4,
            maxlength: 30,
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
            url: "/admin/create_team_members",
            method: "POST",
            dataType: "JSON",
            data: new FormData(form),
            contentType: false,
            processData: false,
            success: function (data) {
                $("#btn").attr("disabled", false);
                $("#btn").html("Submit");
                Command: toastr[data.icon](data.title, data.msg);
                if (data.status) {
                    $("#add_team_members_form").trigger("reset");
                }
            },
            error: function () {
                $("#btn").attr("disabled", false);
                $("#btn").html("Submit");
                Command: toastr["error"]("Error", "Technical Issue");
            },
        });
    },
});

// THIS IS DeleteTeamMembers FUNCTION

function DeleteTeamMembers(id) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "team_member_delete",
                data: { id: id },
                dataType: "JSON",
                success: function (data) {
                    swal.fire({
                        icon: data.icon,
                        title: data.title,
                    });
                    if (data.status) {
                        $("#" + id).hide();
                    }
                },
                error: function () {
                    $("#btn").attr("disabled", false);
                    $("#btn").html("Submit");
                    Command: toastr["error"]("Error", "Technical Issue");
                },
            });
        }
    });
}

// THIS IS DeleteTeamMembers FUNCTION
// THIS IS updateMembers FUNCTION

function updateMembers() {
    var countryCodeTitle = $(".iti__selected-flag").attr("title");
    var countryCode = countryCodeTitle.match(/\+\d+/)[0];
    $("#country_code").val(countryCode);
}
$("#update_team_members").validate({
    rules: {
        name: "required",
        phone: "required",
        email: {
            required: true,
            email: true,
        },
        dob: "required",
        pin: "required",
        password: {
            required: true,
            minlength: 4,
            maxlength: 30,
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
            url: "/admin/update_members",
            method: "POST",
            dataType: "JSON",
            data: new FormData(form),
            contentType: false,
            processData: false,
            success: function (data) {
                $("#btn").attr("disabled", false);
                $("#btn").html("Update");
                Command: toastr[data.icon](data.title, data.msg);
                if (data.status) {
                    $("#update_team_members").trigger("reset");
                }
            },
            error: function () {
                $("#btn").attr("disabled", false);
                $("#btn").html("Submit");
                Command: toastr["error"]("Error", "Technical Issue");
            },
        });
    },
});

$("#add_customer_form").validate({
    rules: {
        customer_service_id: "required",
        type: "required",
    },
    messages: {},
    submitHandler: function (form, event) {
        event.preventDefault();
        $("#btn").html(
            "<button class='btn btn-primary' type='button' disabled> <span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span><span class='visually-hidden'>Loading...</span></button>"
        );
        $("#btn").attr("disabled", true);
        $.ajax({
            url: "/admin/create_lead",
            method: "POST",
            dataType: "JSON",
            data: new FormData(form),
            contentType: false,
            processData: false,
            success: function (data) {
                $("#btn").attr("disabled", false);
                $("#btn").html("Submit");
                Command: toastr[data.icon](data.title, data.msg);
                if (data.status) {
                    $("#add_customer_form").trigger("reset");
                }
            },
            error: function () {
                $("#btn").attr("disabled", false);
                $("#btn").html("Submit");
                Command: toastr["error"]("Error", "Technical Issue");
            },
        });
    },
});

// Remark Start
$("#remark_form").validate({
    rules: {
        remark: {
            required: true,
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
            url: "/admin/remarks",
            method: "POST",
            dataType: "JSON",
            data: new FormData(form),
            contentType: false,
            processData: false,
            success: function (data) {
                $("#btn").attr("disabled", false);
                $("#btn").html("Submit");

                Command: toastr[data.icon](data.title, data.msg);
                if (data.status) {
                    $("#remark_form").trigger("reset");
                    location.reload();
                }
            },
            error: function () {
                $("#btn").attr("disabled", false);
                $("#btn").html("Submit");
                Command: toastr["error"]("Error", "Technical Issue");
            },
        });
    },
});
// Remark End

$("#email_send").validate({
    rules: {
        editor2: "required",
    },
    messages: {},
    submitHandler: function (form, event) {
        event.preventDefault();
        $("#btn").html(
            "<button class='btn btn-primary' type='button' disabled> <span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span><span class='visually-hidden'>Loading...</span></button>"
        );
        $("#btn").attr("disabled", true);
        $.ajax({
            url: "/admin/send-email",
            method: "POST",
            dataType: "JSON",
            data: new FormData(form),
            contentType: false,
            processData: false,
            success: function (data) {
                $("#btn").attr("disabled", false);
                $("#btn").html("Send Email");
                Command: toastr[data.icon](data.title, data.msg);
                if (data.status) {
                    $(".cke_wysiwyg_frame ").css("display", "none");
                }
            },
            error: function () {
                $("#btn").attr("disabled", false);
                $("#btn").html("Submit");
                Command: toastr["error"]("Error", "Technical Issue");
            },
        });
    },
});

// THIS IS message_send FUNCTION
$("#message_send").validate({
    rules: {
        editor2: "required",
    },
    messages: {},
    submitHandler: function (form, event) {
        event.preventDefault();
        $("#btn").html(
            "<button class='btn btn-primary' type='button' disabled> <span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span><span class='visually-hidden'>Loading...</span></button>"
        );
        $("#btn").attr("disabled", true);
        $.ajax({
            url: "/admin/send-message",
            method: "POST",
            dataType: "JSON",
            data: new FormData(form),
            contentType: false,
            processData: false,
            success: function (data) {
                $("#btn").attr("disabled", false);
                $("#btn").html("Send Message");
                Command: toastr[data.icon](data.title, data.msg);
                if (data.status) {
                    $("#message_send ").trigger("reset");
                }
            },
            error: function (data) {
                $("#btn").attr("disabled", false);
                $("#btn").html("Send Message");
                Command: toastr["error"](
                    "Server Down",
                    "Please Try Again later..!"
                );
            },
        });
    },
});
$("#create_invoice_form").validate({
    rules: {
        price: "required",
        qty: "required",
        amount: "required",
        description: "required",
    },
    messages: {},
    submitHandler: function (form, event) {
        event.preventDefault();
        var customer_id = $("#customer_id").val();

        $("#btn").html(
            "<button class='btn btn-primary' type='button' disabled> <span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span><span class='visually-hidden'>Loading...</span></button>"
        );
        $("#btn").attr("disabled", true);
        $.ajax({
            url: "/admin/save_invoice",
            method: "POST",
            dataType: "JSON",
            data: new FormData(form),
            contentType: false,
            processData: false,
            success: function (data) {
                $("#btn").attr("disabled", false);
                $("#btn").html("Submit");
                Command: toastr[data.icon](data.title, data.msg);
                var customer_package_tem_id = data.title;
                if (data.status) {
                    window.location =
                        "/admin/invoice/" + customer_package_tem_id;
                }
            },
            error: function () {
                $("#btn").attr("disabled", false);
                $("#btn").html("Submit");
                Command: toastr["error"]("Error", "Technical Issue");
            },
        });
    },
});

function ConvertToClient(customer_id = "", user_id = "", role = "") {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to change this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, convert it!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "convert_to_client",
                data: {
                    customer_id: customer_id,
                    user_id: user_id,
                    role: role,
                },
                dataType: "JSON",
                success: function (data) {
                    swal.fire({
                        icon: data.icon,
                        title: data.title,
                    });
                    if (data.status) {
                        $("#" + customer_id).hide();
                    }
                },
                error: function () {
                    $("#btn").attr("disabled", false);
                    $("#btn").html("Submit");
                    Command: toastr["error"]("Error", "Technical Issue");
                },
            });
        }
    });
}

//Email template Start
$("#email_template_send").validate({
    rules: {
        editor2: "required",
    },
    messages: {},
    submitHandler: function (form, event) {
        event.preventDefault();
        $("#btn").html(
            "<button class='btn btn-primary' type='button' disabled> <span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span><span class='visually-hidden'>Loading...</span></button>"
        );
        $("#btn").attr("disabled", true);
        $.ajax({
            url: "/admin/send-email-template",
            method: "POST",
            dataType: "JSON",
            data: new FormData(form),
            contentType: false,
            processData: false,
            success: function (data) {
                $("#btn").attr("disabled", false);
                $("#btn").html("Send Email");
                Command: toastr[data.icon](data.title, data.msg);
                if (data.status) {
                    $(".cke_wysiwyg_frame ").css("display", "none");
                }
            },
            error: function () {
                $("#btn").attr("disabled", false);
                $("#btn").html("Submit");
                Command: toastr["error"]("Error", "Technical Issue");
            },
        });
    },
});

//Email template End

$("#invoice_email_send").validate({
    messages: {},
    submitHandler: function (form, event) {
        event.preventDefault();
        $("#btn").html(
            "<button class='btn btn-primary' type='button' disabled> <span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span><span class='visually-hidden'>Loading...</span></button>"
        );
        $("#btn").attr("disabled", true);
        $.ajax({
            url: "/admin/invoice-send-email",
            method: "POST",
            dataType: "JSON",
            data: new FormData(form),
            contentType: false,
            processData: false,
            success: function (data) {
                $("#btn").attr("disabled", false);
                $("#btn").html("Send Email");
                Command: toastr[data.icon](data.title, data.msg);
                if (data.status) {
                    $(".cke_wysiwyg_frame ").css("display", "none");
                }
            },
            error: function () {
                $("#btn").attr("disabled", false);
                $("#btn").html("Submit");
                Command: toastr["error"]("Error", "Technical Issue");
            },
        });
    },
});

function ChangeStatus(customer_id = "", status = "") {
    Swal.fire({
        title: "Are you sure?",
        text: "You want to change the Lead Status!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, change it!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "/admin/change_status",
                data: {
                    customer_id: customer_id,
                    status: status,
                },
                dataType: "JSON",
                success: function (data) {
                    swal.fire({
                        icon: data.icon,
                        title: data.title,
                    });
                    location.reload();
                    if (data.status) {
                        $("#" + customer_id).hide();
                    }
                },
                error: function () {
                    $("#btn").attr("disabled", false);
                    $("#btn").html("Submit");
                    Command: toastr["error"]("Error", "Technical Issue");
                },
            });
        }
    });
}

$("#add-service").validate({
    messages: {},
    submitHandler: function (form, event) {
        event.preventDefault();
        $("#btn").html(
            "<button class='btn btn-primary' type='button' disabled> <span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span><span class='visually-hidden'>Loading...</span></button>"
        );
        $("#btn").attr("disabled", true);
        $.ajax({
            url: "/admin/update_service_data",
            method: "POST",
            dataType: "JSON",
            data: new FormData(form),
            contentType: false,
            processData: false,
            success: function (data) {
                $("#btn").attr("disabled", false);
                $("#btn").html("update");
                var customer_id = data;
                if (data.status == false) {
                    Command: toastr["error"]("Error", data.title);
                } else {
                    Command: toastr["success"](
                        "Success",
                        "Updated Successfully"
                    );
                }

                // setTimeout(() => {
                //     window.location = "/admin/leads-view/" + customer_id;
                // }, 1500);
            },
            error: function () {
                $("#btn").attr("disabled", false);
                $("#btn").html("update");
            },
        });
    },
});

$("#add_role_form").validate({
    rules: {
        name: "required",
    },

    messages: {},
    submitHandler: function (form, event) {
        event.preventDefault();

        // $("#btn").html(
        //     "<button class='btn btn-primary' type='button' disabled> <span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span><span class='visually-hidden'>Loading...</span></button>"
        // );
        $("#btn").attr("disabled", true);
        $("#btn").html("Please Wait..");
        $.ajax({
            url: "/admin/add-role",
            method: "POST",
            dataType: "JSON",
            data: new FormData(form),
            contentType: false,
            processData: false,
            success: function (data) {
                $("#btn").attr("disabled", false);
                $("#btn").html("Create Role");
                Command: toastr[data.icon](data.title, data.msg);
                if (data.status) {
                    $("#add_role_form").trigger("reset");
                    document.getElementById("name").value = "";
                }
            },
            error: function () {
                $("#btn").attr("disabled", false);
                $("#btn").html("Create Role");
                Command: toastr["error"]("Error", "Technical Issue");
            },
        });
    },
});

$("#update_role_form").validate({
    rules: {
        name: "required",
    },
    messages: {},
    submitHandler: function (form, event) {
        event.preventDefault();
        $("#btn").html(
            "<button class='btn btn-primary' type='button' disabled> <span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span><span class='visually-hidden'>Loading...</span></button>"
        );
        $("#btn").attr("disabled", true);
        $.ajax({
            url: "/admin/update_role",
            method: "POST",
            dataType: "JSON",
            data: new FormData(form),
            contentType: false,
            processData: false,
            success: function (data) {
                $("#btn").attr("disabled", false);
                $("#btn").html("Update");
                Command: toastr[data.icon](data.title, data.msg);
                if (data.status) {
                    // document.getElementById("name").value = "";
                }
            },
            error: function () {
                $("#btn").attr("disabled", false);
                $("#btn").html("Submit");
                Command: toastr["error"]("Error", "Technical Issue");
            },
        });
    },
});

function DeleteRole(id) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "/admin/role_delete",
                method: "POST",
                data: { id: id },
                dataType: "JSON",
                success: function (data) {
                    Command: toastr[data.icon](data.title, data.msg);
                    if (data.status) {
                        $("#" + id).hide();
                    }
                },
                error: function () {
                    $("#btn").attr("disabled", false);
                    $("#btn").html("Submit");
                    Command: toastr["error"]("Error", "Technical Issue");
                },
            });
        }
    });
}
