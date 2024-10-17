$("#add_package_form").validate({
        rules: {
            title: "required",
            price: "required",
        },
        messages: {},
        submitHandler: function (form, event) {
            event.preventDefault();
            $("#btn").html(
                "<button class='btn btn-primary' type='button' disabled> <span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span><span class='visually-hidden'>Loading...</span></button>"
                );
            $("#btn").attr("disabled", true);
            $.ajax({
                url: "/admin/save_package",
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
                      document.getElementById('title').value='';
                      document.getElementById('price').value='';
                      document.getElementById('desc').value='';
                    }
                },
            });
        },
    });

$("#update_package_form").validate({
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
            url: "/admin/update_package",
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
                   document.getElementById('title').value='';
                   document.getElementById('price').value='';
                   document.getElementById('desc').value='';

                }
            },
        });
    },
});

function DeletePackage(id) {
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
                url: "package_delete",
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
