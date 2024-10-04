//function addServices() {
    $("#add_service_form").validate({
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
                url: "/admin/add-service",
                method: "POST",
                dataType: "JSON",
                data: new FormData(form),
                contentType: false,
                processData: false,
                success: function (data) {
                    $("#btn").attr("disabled", false);
                    $("#btn").html("Submit");
                    Command: toastr[data.icon](data.title, data.msg);
                    if(data.status){
                       // $("#add_service_form").trigger("reset");
                       document.getElementById('name').value='';
                    }
                },
            });
        },
    });
//}
//ServiceDelete Start
function DeleteService(id) {
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
                url: "service_delete",
                method: "POST",
                data: { id: id },
                dataType: "JSON",
                success: function (data) {
                    Command: toastr[data.icon](data.title, data.msg);
                    if (data.status) {
                        $("#" + id).hide();
                    }
                },
            });
        }
    });
}
//ServiceDelete End
//ServiceUpdate Start
$("#update_service_form").validate({
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
            url: "/admin/update_service",
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
                  document.getElementById('name').value='';

                }
            },
        });
    },
});

//Serviceupdate End