(function ($) {
    var eDatePickerContainer = $('#datepicker_custom');

    if (eDatePickerContainer.length > 0) {
        var url = base_url+ '/events/calendar';
        $.get(url, eDatePickerContainer.data(), function (res) {
            if (res.type == 1) {
                eDatePickerContainer.html(res.html);
            } else {

            }
        });

        eDatePickerContainer.on('click', $("a.ui-corner-all"), function (event) {
            var param = eDatePickerContainer.data();
            param.month = $(event.target).data('month');
            param.year = $(event.target).data('year');
            $.get(url, param, function (res) {
                if (res.type == 1) {
                    eDatePickerContainer.html(res.html);
                } else {

                }
            });
        });

    }
})(window.jQuery);