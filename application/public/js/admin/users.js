var user = {
        id: null,
        key: null,
        csrf_token: null,
    },
    table = {},
    form = { el: [] },
    input = { index: [] };

var index = {
    saveUser: function (form_el) {
        var form_data = new FormData(form_el);
    },
};

$(() => {
    initUsers();

    checkElementsName(form.el);
});

function initUsers() {
    form.el = $("form[name$=_form].index-form");
}

function initPlugins() {}

function checkElementsName(elements) {
    var inspect = {
        elements: [],
        ids: [],
        names: [],
    };

    inspect.elements = elements;

    $.each(elements, function (i, element) {
        inspect.ids.push($(element).attr("id"));
        inspect.names.push($(element).attr("name"));
    });

    console.log(inspect);
}
