(function ($) {
    var eDatePickerContainer = $('#datepicker_custom');

    if (eDatePickerContainer.length > 0) {
        var url = base_url+ '/calendar_widget';
        console.log(url);
        $.get(url, eDatePickerContainer.data(), function (res) {
            if (res.type == 1) {
                eDatePickerContainer.html(res.html);
            } else {

            }
        });
    }
})(window.jQuery);