var user = {
        id: null,
        key: null,
        csrf_token: null,
        save: function (form_el) {
            var form_data = new FormData(form_el);

            console.log(form_data);

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": user.csrf_token,
                    // Authorization: `Bearer ${user.key}`,
                },
            });

            $.ajax({
                type: "POST",
                url: `${api()}/admin/users`,
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
                    $("#make-reservation-modal").modal("hide");
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
                    $(".modal-content.ajax-loader").removeClass("active");
                    table.schedules.ajax.reload(null, false);
                });
        },
    },
    table = {
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
                                        <button class="btn btn-material btn-secondary" data-modal="#manage-user-modal" data-user_id="${object.id}" data-toggle="tooltip" data-placement="top" title="Manage">
                                            <i class="material-icons">settings</i>
                                        </button>
                                        <button class="btn btn-material btn-info" data-modal="#view-user-modal" data-user_id="${object.id}" data-toggle="tooltip" data-placement="top" title="View">
                                            <i class="material-icons">search</i>
                                        </button>
                                        <button class="btn btn-material btn-primary" data-modal="#edit-user-modal" data-user_id="${object.id}" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="material-icons">edit</i>
                                        </button>
                                        <button class="btn btn-material btn-danger" data-modal="#delete-user-modal" data-user_id="${object.id}" data-toggle="tooltip" data-placement="top" title="Delete">
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
    input = { filter: [], add_student: [] };

$(() => {
    initUsers();

    $(form.el[0]).on("submit", function (event) {
        event.preventDefault();

        alert();
    });

    $(form.el[1]).on("submit", function (event) {
        event.preventDefault();

        $(".modal-content.ajax-loader").addClass("active");
        user.save(this);
    });

    $(document).on("click", ".action-buttons button", function () {
        var modal = $(this).data('modal');
        $(modal).modal("show");
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
});

function initUsers() {
    user.id = $("meta[name=user_id]").attr("content");
    user.key = $("meta[name=api_token]").attr("content");
    user.csrf_token = $('meta[name="csrf_token"]').attr("content");

    form.el = $("form[name$=_form].users-form");

    input.filter = $(".filter-input");
    input.add_student = $(".add-student-input");

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
