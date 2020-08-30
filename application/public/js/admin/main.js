$(() => {
    initMain();

    $(".hamburger").on("click", function (event) {
        $(this).toggleClass("is-active");
        $("section.sidebar").toggleClass("active");
        $("main").toggleClass("active");
        $("body .wrapper").css("overflow-x", "hidden");
    });

    $(".drop-type button").on("click", function () {
        $(this).toggleClass("active");

        if ($(this).hasClass("active")) {
            $(this).find(".nav-arrow").text("keyboard_arrow_down");
            $(this).parent().find(".sub-list").slideDown("fast");
        } else {
            $(this).find(".nav-arrow").text("keyboard_arrow_right");
            $(this)
                .parent()
                .find(".sub-list")
                .stop(true, false)
                .slideUp("fast");
        }
    });
});

function initMain() {
    hideSubLists();

    if (media().desktop) {
        $("section.sidebar").toggleClass("active");
        $("main").toggleClass("active");
    }

    initMainPlugins();
}

function initMainPlugins() {
    $("body").tooltip({
        selector: '[data-toggle="tooltip"]',
    });
}

function hideSubLists() {
    $(".sub-list").stop(true, false).slideUp("fast");
}

function checkElementsName(elements) {
    var inspect = {
        elements: [],
        ids: [],
        names: [],
        values: [],
    };

    inspect.elements = elements;

    $.each(elements, function (i, element) {
        inspect.ids.push($(element).attr("id"));
        inspect.names.push($(element).attr("name"));
        inspect.values.push($(element).attr("value"));
    });

    console.log(inspect);
}

function clearForm(form) {
    $(form)
        .find("input")
        .not("button, submit, reset, hidden, checkbox, radio")
        .val("");
    $(form).find(":checkbox, :radio").prop("checked", false);
}

function ajaxModalLoading(state, element) {
    if(state) {
        $(element).find(".modal-content.ajax-loader").addClass("active");
    } else {
        $(element).find(".modal-content.ajax-loader").removeClass("active");
    }
}

function ajaxMainLoading(state) {
    if(state) {
        $("section.topbar .ajax-wrap").addClass("active");
        $("section.topbar .ajax-loader").addClass("active");
    } else {
        $("section.topbar .ajax-wrap").removeClass("active");
        $("section.topbar .ajax-loader").removeClass("active");
    }
}

function media() {
    if (window.matchMedia("(min-width: 992px)").matches) {
        return {
            desktop: true,
            tablet: false,
            mobile: false,
        };
    } else if (window.matchMedia("(min-width: 768px)").matches) {
        return {
            desktop: false,
            tablet: true,
            mobile: false,
        };
    } else {
        return {
            desktop: false,
            tablet: false,
            mobile: true,
        };
    }
}

function notify(data) {
    $.toast({
        text: data.message,
        heading: data.heading,
        icon: data.icon,
        showHideTransition: "slide",
        allowToastClose: true,
        hideAfter: data.timeout,
        stack: 5,
        position: "top-right",
        textAlign: "left",
        loader: true,
        loaderBg: "#777672",
        bgColor: "#171717",
        textColor: "white",
        afterHidden: data.event,
    });
}
