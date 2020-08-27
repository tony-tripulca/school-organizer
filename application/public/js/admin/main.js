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
}

function initPlugins() {}

function hideSubLists() {
    $(".sub-list").stop(true, false).slideUp("fast");
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
