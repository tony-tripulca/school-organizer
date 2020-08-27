var user = {
        id: null,
        key: null,
        csrf_token: null,
    },
    table = {},
    form = { el: [] },
    modal = { el: [] },
    input = { filter: [], add_student: [] };

var index = {
    saveUser: function (form_el) {
        var form_data = new FormData(form_el);
    },
};

$(() => {
    initUsers();

    $(form.el[0]).on("submit", function (event) {
        event.preventDefault();

        alert();
    });

    $(form.el[1]).on("submit", function (event) {
        event.preventDefault();

        alert();
    });

    checkElementsName(form.el);
});

function initUsers() {
    form.el = $("form[name$=_form]");

    input.filter = $("input[type=checkbox]");
    input.add_student = $(".add-student-input");
}

function initPlugins() {}
