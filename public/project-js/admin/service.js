//function addServices() {
$("#add_service_form").validate({
    rules: {
        name: "required",
      
    },

    messages: {},
    submitHandler: function (form, event) {
        event.preventDefault();
    //     const subService = document.getElementsByClassName('subcategory-input');
    // console.log(subService[0]);

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
                if (data.status) {
                    $("#add_service_form").trigger("reset");
                    document.getElementById("name").value = "";
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
                error: function () {
                    $("#btn").attr("disabled", false);
                    $("#btn").html("Submit");
                    Command: toastr["error"]("Error", "Technical Issue");
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
                    document.getElementById("name").value = "";
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

//Serviceupdate End
jQuery.fn.extend({
    createRepeater: function (options = {}) {
        var hasOption = function (optionKey) {
            return options.hasOwnProperty(optionKey);
        };

        var option = function (optionKey) {
            return options[optionKey];
        };

        var generateId = function (string) {
            return string
                .replace(/\[/g, '_')
                .replace(/\]/g, '')
                .toLowerCase();
        };

        var addItem = function (items, key, fresh = true) {
            var itemContent = items;
            var group = itemContent.data("group");
            var item = itemContent;
            var input = item.find('input,select,textarea');

            input.each(function (index, el) {
                var attrName = $(el).data('name1');
                var skipName = $(el).data('skip-name');
                if (skipName != true) {
                    $(el).attr("name", group + "[" + key + "]" + "[" + attrName + "]");
                } else {
                    if (attrName != 'undefined') {
                        $(el).attr("name", attrName);
                    }
                }
                if (fresh == true) {
                    $(el).attr('value', '');
                }

                $(el).attr('id', generateId($(el).attr('name')));
                $(el).parent().find('label').attr('for', generateId($(el).attr('name')));
            })

            var itemClone = items;

            /* Handling remove btn */
            var removeButton = itemClone.find('.remove-btn');

            if (key == 0) {
                removeButton.attr('disabled', true);
            } else {
                removeButton.attr('disabled', false);
            }

            removeButton.attr('onclick', '$(this).parents(\'.items\').remove()');

            var newItem = $("<div class='items'>" + itemClone.html() + "<div/>");
            newItem.attr('data-index', key)

            newItem.appendTo(repeater);
        };

        /* find elements */
        var repeater = this;
        var items = repeater.find(".items");
        var key = 0;
        var addButton = repeater.find('.repeater-add-btn');

        items.each(function (index, item) {
            items.remove();
            if (hasOption('showFirstItemToDefault') && option('showFirstItemToDefault') == true) {
                addItem($(item), key);
                key++;
            } else {
                if (items.length > 1) {
                    addItem($(item), key);
                    key++;
                }
            }
        });

        /* handle click and add items */
        addButton.on("click", function () {
            addItem($(items[0]), key);
            key++;
        });
    }
});
