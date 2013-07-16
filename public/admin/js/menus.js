$(function () {
    $('._menus-type').on('change', 'input', function () {
        var e = $(this),
            container = $('#' +e.val() + '-form');

        $('._extra-form').addClass('hide');

        container.length && container.removeClass('hide');
    });
});