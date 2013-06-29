$(function () {
    $('select[name="input[path]"]').change(function() {
        var e = $(this);
        if ('' == e.val()) {
            return;
        }

        $.get('widget/extend_form',
            {   'path' : e.val(),
                'widget_id' : e.data('data-widget-id')
            }, function (res) {
                $('#_wb-options-form').html(res.html);
            });
    });
});