(function ($) {
    $("button#send_mess").click(function () {
        var e = $(this);
        event.preventDefault();
        if (e.data('disable')) {
            return;
        }
        e.data('disable', true);
        $.post(base_url + '/contact/mess', $("#contact_form").serialize(), function(res) {
            e.removeData('disable');
            if (res.type != 1) {
                var error = '';
                $.each(res.message, function (key, value) {
                    console.log(key, value);
                    error += value + '. ';
                });

                $('#success').html('').hide();
                $("#error").html(error).show();
            } else {
                $("#contact_form")[0].reset();
                $('#error').html('').hide();
                $('#success').html(res.message).show();
            }
        });
    });
})(jQuery);