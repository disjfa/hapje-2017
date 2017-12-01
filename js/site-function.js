/**
 * File skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
(function ($) {
    var brand = $('.navbar-brand');
    var topMargin = 72;

    function checkScrollTop() {
        if ($(window).scrollTop() <= topMargin) {
            brand.removeClass('not-on-top');
        } else {
            brand.addClass('not-on-top');
        }
    }

    $(window).on('scroll', function () {
        checkScrollTop();
    });
    $(function () {
        checkScrollTop();
    })
})(jQuery);
