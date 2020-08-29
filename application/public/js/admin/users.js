var user = {
    id: null,
    key: null,
    csrf_token: null,
};

var users = {
    id: null,
    fillReadModal: function (data) {
        $(input.read[0]).val(
            `${data.last_name}, ${data.first_name} ${data.middle_name ?? ""} ${
                data.suffix ?? ""
            }`
        );
        $(input.read[1]).val(`${data.full_address ?? ""}`);
        $(input.read[2]).val(`${data.email ?? ""}`);
        $(input.read[3]).val(`${data.mobile ?? ""}`);
    },
    fillUpdateModal: function (data) {
        if (data.type_id == 6) {
            $("#update-user-modal .for-student").show();
        } else {
            $("#update-user-modal .for-student").hide();
        }

        $(input.update[0]).val(data.last_name);
        $(input.update[1]).val(data.first_name);
        $(input.update[2]).val(data.middle_name);
        $(input.update[3]).val(data.suffix);
        $(input.update[4]).val(data.gender);
        $(input.update[5]).val(data.full_address);
        $(input.update[6]).val(data.email);
        $(input.update[7]).val(data.mobile);
        $(input.update[8]).val(data.father_name);
        $(input.update[9]).val(data.father_mobile);
        $(input.update[10]).val(data.mother_name);
        $(input.update[11]).val(data.mother_mobile);
    },
    getUserInfo: function (modal, callback) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": user.csrf_token,
                // Authorization: `Bearer ${user.key}`,
            },
        });

        $.ajax({
            type: "GET",
            url: `${api()}/admin/users/${users.id}`,
            processData: false,
            contentType: false,
        })
            .done(function (response) {
                notify({
                    message: "Info has been retrieved",
                    heading: "Success",
                    icon: "success",
                    timeout: 3000,
                });
                callback(response.data);
            })
            .fail(function (error) {
                notify({
                    message: "Oops! Something went wrong",
                    heading: "Error",
                    icon: "error",
                    timeout: 3000,
                });
                console.log(error);
            })
            .always(function () {
                $(modal)
                    .find(".modal-content.ajax-loader")
                    .removeClass("active");
            });
    },
    manage: function (element, id) {
        users.id = id;
        
        $(element.modal)
            .find(".modal-content.ajax-loader")
            .removeClass("active");
    },
    save: function (fn, element) {
        var form_data = new FormData(element.form);

        var api_url = "";
        switch (fn) {
            case "create":
                api_url = `${api()}/admin/users`;
                break;
            case "update":
                form_data.append("_method", "PUT");
                api_url = `${api()}/admin/users/${users.id}`;
                break;
        }

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": user.csrf_token,
                // Authorization: `Bearer ${user.key}`,
            },
        });

        $.ajax({
            type: "POST",
            url: api_url,
            data: form_data,
            processData: false,
            contentType: false,
        })
            .done(function (response) {
                notify({
                    message: response.success,
                    heading: "Success",
                    icon: "success",
                    timeout: 8000,
                });
                $(element.modal).modal("hide");
            })
            .fail(function (error) {
                var err_messages = [];

                if (error.responseJSON.code == 422) {
                    err_messages.push(error.responseJSON.message);
                } else {
                    $.each(error.responseJSON.errors, function (i, errors) {
                        err_messages.push(Array.from(errors));
                    });
                }

                showInputError(error.responseJSON.errors);

                notify({
                    message: err_messages,
                    heading: "Error",
                    icon: "error",
                    timeout: 8000,
                });
            })
            .always(function () {
                $(element.modal)
                    .find(".modal-content.ajax-loader")
                    .removeClass("active");
                table.users.el.ajax.reload(null, false);
            });
    },
    read: function (element, id) {
        users.id = id;

        this.getUserInfo(element.modal, function (data) {
            users.fillReadModal(data);
        });
    },
    update: function (element, id) {
        users.id = id;

        this.getUserInfo(element.modal, function (data) {
            users.fillUpdateModal(data);
        });
    },
    delete: function (element, id) {
        users.id = id;
        $(element.modal)
            .find(".modal-content.ajax-loader")
            .removeClass("active");
    },
};
var table = {
        users: {
            el: null,
            generate: function () {
                try {
                    table.users.el = $("#users-table").DataTable({
                        responsive: true,
                        bAutoWidth: false,
                        order: [[0, "desc"]],
                        ajax: {
                            type: "GET",
                            headers: {
                                // Authorization: `Bearer ${user.key}`,
                            },
                            url: `${api()}/admin/users`,
                            data: function (data) {
                                data.filters = null;
                            },
                        },
                        drawCallback: function (settings) {
                            // var api = this.api();
                            $("main .ajax-loader").removeClass("active");
                        },
                        columns: [
                            {
                                data: null,
                                render: function (object) {
                                    return `${object.last_name}, ${object.first_name}`;
                                },
                            },
                            { data: "email" },
                            { data: "mobile" },
                            { data: "full_address" },
                            { data: "father_name" },
                            { data: "father_mobile" },
                            { data: "mother_name" },
                            { data: "mother_mobile" },
                            {
                                data: null,
                                sortable: false,
                                class: "action-buttons",
                                render: function (object) {
                                    return `
                                        <button class="btn btn-material btn-secondary" data-fn="manage" data-modal="#manage-user-modal" data-resource_id="${object.id}" data-toggle="tooltip" data-placement="top" title="Manage">
                                            <i class="material-icons">settings</i>
                                        </button>
                                        <button class="btn btn-material btn-info" data-fn="read" data-modal="#read-user-modal" data-resource_id="${object.id}" data-toggle="tooltip" data-placement="top" title="View">
                                            <i class="material-icons">search</i>
                                        </button>
                                        <button class="btn btn-material btn-primary" data-fn="update" data-modal="#update-user-modal" data-resource_id="${object.id}" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="material-icons">edit</i>
                                        </button>
                                        <button class="btn btn-material btn-danger" data-fn="delete" data-modal="#delete-user-modal" data-resource_id="${object.id}" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="material-icons">clear</i>
                                        </button>
                                    `;
                                },
                            },
                        ],
                    });
                } catch (error) {
                    console.log({
                        component: "Users Table",
                        err: [error],
                    });
                }
            },
        },
    },
    form = { el: [] },
    modal = { el: [] },
    input = { filter: [], create: [], read: [], update: [] };

$(() => {
    initUsers();

    $(form.el[0]).on("submit", function (event) {
        event.preventDefault();

        alert();
    });

    $(form.el[2]).on("submit", function (event) {
        event.preventDefault();

        $("#create-user-modal .modal-content.ajax-loader").addClass("active");
        users.save("create", { modal: $("#create-user-modal"), form: this });
    });

    $(form.el[4]).on("submit", function (event) {
        event.preventDefault();

        $("#update-user-modal .modal-content.ajax-loader").addClass("active");
        users.save("update", { modal: $("#update-user-modal"), form: this });
    });

    $(document).on("click", ".action-buttons button", function () {
        var html_modal = $(this).data("modal");

        $(html_modal).find(".modal-content.ajax-loader").addClass("active");
        $(html_modal).modal("show");

        switch ($(this).data("fn")) {
            case "manage":
                users.manage({ modal: html_modal }, $(this).data("resource_id"));
                break;
            case "read":
                users.read({ modal: html_modal }, $(this).data("resource_id"));
                break;
            case "update":
                users.update({ modal: html_modal }, $(this).data("resource_id"));
                break;
            case "delete":
                users.delete({ modal: html_modal }, $(this).data("resource_id"));
                break;
        }
    });

    $(".filter-input").on("click", function () {
        $("main .ajax-loader").addClass("active");
        table.users.el.ajax.reload(null, false);
    });

    $("input").on("change", function () {
        $(this).css({
            "box-shadow": "none",
        });
    });

    checkElementsName(input.update);
});

function initUsers() {
    user.id = $("meta[name=user_id]").attr("content");
    user.key = $("meta[name=api_token]").attr("content");
    user.csrf_token = $('meta[name="csrf_token"]').attr("content");

    form.el = $("form[name$=_form].users-form");

    input.filter = $(".filter-input");
    input.create = $(".create-input");
    input.read = $(".read-input");
    input.update = $(".update-input");

    initUsersPlugins();
}

function initUsersPlugins() {
    table.users.generate();
}

function showInputError(errors) {
    $.each(errors, function (index, err) {
        $(`input[type=text][name=${index}`).css({
            "box-shadow": "1px 1px 4px red",
        });
    });
}
