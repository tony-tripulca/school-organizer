var user = {
    id: null,
    key: null,
    csrf_token: null,
};

var users = {
    id: null,
    manage: function (element, id) {
        users.id = id;

        ajaxModalLoading(false, element.modal);
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
                ajaxModalLoading(false, modal);
            });
    },
    read: function (element, id) {
        users.id = id;

        ajaxModalLoading(true, element.modal);

        this.getUserInfo(element.modal, function (data) {
            users.fillReadModal(data);
        });
    },
    fillReadModal: function (data) {
        $(input.read[0]).val(
            `${data.last_name}, ${data.first_name} ${data.middle_name || ""} ${
                data.suffix || ""
            }`
        );
        $(input.read[1]).val(`${data.full_address || ""}`);
        $(input.read[2]).val(`${data.email || ""}`);
        $(input.read[3]).val(`${data.mobile || ""}`);
    },
    update: function (element, id) {
        users.id = id;

        ajaxModalLoading(true, element.modal);

        this.getUserInfo(element.modal, function (data) {
            users.fillUpdateModal(data);
        });
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
    save: function (fn, element) {
        var form_data = new FormData(element.form);

        ajaxModalLoading(true, element.modal);

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
                    timeout: 3000,
                });
                $(element.modal).modal("hide");
                clearForm(element.form);
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
                    timeout: 3000,
                });
            })
            .always(function () {
                ajaxModalLoading(false, element.modal);
                ajaxMainLoading(true);
                table.users.el.ajax.reload(null, false);
            });
    },
    delete: function (element, id) {
        users.id = id;

        $(element.modal).modal("show");
    },
    confirmDelete: function (element) {
        ajaxModalLoading(true, element.modal);

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": user.csrf_token,
                // Authorization: `Bearer ${user.key}`,
            },
        });

        $.ajax({
            type: "DELETE",
            url: `${api()}/admin/users/${users.id}`,
            processData: false,
            contentType: false,
        })
            .done(function (response) {
                notify({
                    message: response.success,
                    heading: "Success",
                    icon: "success",
                    timeout: 3000,
                });
                $(element.modal).modal("hide");
            })
            .fail(function (error) {
                notify({
                    message: "Oops! Something went wrong",
                    heading: "Error",
                    icon: "error",
                    timeout: 3000,
                });
            })
            .always(function () {
                ajaxModalLoading(false, element.modal);
                ajaxMainLoading(true);
                table.users.el.ajax.reload(null, false);
            });
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
                        order: [[0, "asc"]],
                        ajax: {
                            type: "GET",
                            headers: {
                                // Authorization: `Bearer ${user.key}`,
                            },
                            url: `${api()}/admin/users`,
                            data: function (data) {
                                var records = [],
                                    gender = [];

                                $.each(input.filter.records, function (
                                    index,
                                    record
                                ) {
                                    records.push(parseInt($(record).val()));
                                });

                                $.each(input.filter.gender, function (
                                    index,
                                    gend
                                ) {
                                    gender.push($(gend).val());
                                });

                                data.user_type_id = $("input[name=user_type_id].filter-input").val();
                                data.records = records;
                                data.gender = gender;
                            },
                        },
                        drawCallback: function (settings) {
                            // var api = this.api();
                            ajaxMainLoading(false);
                        },
                        columns: [
                            {
                                data: null,
                                render: function (object) {
                                    return `${object.last_name}, ${
                                        object.first_name
                                    } ${
                                        object.active
                                            ? ""
                                            : '<small class="badge badge-danger"> Deleted</small>'
                                    }`;
                                },
                            },
                            { data: "email" },
                            { data: "mobile" },
                            { data: "gender" },
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
    input = {
        filter: {
            records: [],
            gender: [],
            incomplete: [],
        },
        create: [],
        read: [],
        update: [],
    };

$(() => {
    initUsers();

    // create_user_form
    $(form.el[2]).on("submit", function (event) {
        event.preventDefault();

        users.save("create", { modal: $("#create-user-modal"), form: this });
    });

    // update_user_form
    $(form.el[4]).on("submit", function (event) {
        event.preventDefault();

        users.save("update", { modal: $("#update-user-modal"), form: this });
    });

    // delete_user_form
    $(form.el[5]).on("submit", function (event) {
        event.preventDefault();

        users.confirmDelete({ modal: $("#delete-user-modal"), form: this });
    });

    $(document).on("click", ".action-buttons button", function () {
        var html_modal = $(this).data("modal");
        $(html_modal).modal("show");

        switch ($(this).data("fn")) {
            case "manage":
                users.manage(
                    { modal: html_modal },
                    $(this).data("resource_id")
                );
                break;
            case "read":
                users.read({ modal: html_modal }, $(this).data("resource_id"));
                break;
            case "update":
                users.update(
                    { modal: html_modal },
                    $(this).data("resource_id")
                );
                break;
            case "delete":
                users.delete(
                    { modal: html_modal },
                    $(this).data("resource_id")
                );
                break;
        }
    });

    $(".filter-input").on("click", function () {
        input.filter.records = $("input[name=records].filter-input:checked");
        input.filter.gender = $("input[name=gender].filter-input:checked");

        ajaxMainLoading(true);
        table.users.el.ajax.reload(null, false);
    });

    $("input").on("change", function () {
        $(this).css({
            "box-shadow": "none",
        });
    });
});

function initUsers() {
    user.id = $("meta[name=user_id]").attr("content");
    user.key = $("meta[name=api_token]").attr("content");
    user.csrf_token = $('meta[name="csrf_token"]').attr("content");

    form.el = $("form[name$=_form].users-form");

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
