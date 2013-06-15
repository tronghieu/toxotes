$(function() {
    $.postJSON = function(url, args, callback, errorCallback) {
        var loading = $('div#loading-box-content');
        loading.fadeIn();
        $.ajax({url: url,
            data: $.param(args),
            dataType: "json",
            type: "POST",
            timeout: 10000,//timeout 10s
            success: function(response) {
                loading.fadeOut();
                if (callback) callback(response);
            }, error: function(response, strError) {
                loading.fadeOut();
                if (errorCallback) {
                    errorCallback(response, strError)
                } else {
                    switch(strError) {
                        case "timeout":
                            //showPopupAlertALine("Có lỗi xảy ra khi kết nối mạng Internet. Bạn vui lòng thử lại!");
                            break;
                    }
                }
            }});
    }

    $.fn.checkAll = function (group, options)
    {
        var opts = $.extend({}, $.fn.checkAll.defaults, options),
            $master = this,

            $slaves = $(group),
            selector,
            groupSize,
            onClick = typeof opts.onClick === 'function' ? opts.onClick : null,
            onMasterClick = typeof opts.onMasterClick === 'function' ? opts.onMasterClick : null,
            reportTo = typeof opts.reportTo === 'function' ? $.proxy(opts.reportTo, $master) : null,

        // for compatibility with 1.4.2 through 1.6
            propFn = typeof $.fn.prop === 'function' ? 'prop' : 'attr',
            onFn = typeof $.fn.on === 'function' ? 'on' : 'live',
            offFn = typeof $.fn.off === 'function' ? 'off' : 'die';

        // omit the master if it was accidentally selected with the slaves
        if ($slaves.index($master) === -1)
        {
            selector = $slaves.selector;
        }
        else
        {
            $slaves = $slaves.not($master.selector);
            selector = $slaves.selector.replace('.not(', ':not(');
        }

        groupSize = $slaves.length;

        if (groupSize === 0)
        {
            // this is kind of a problem
            groupSize = -1;
        }

        function _countChecked()
        {
            return $slaves.filter(':checked').length;
        }

        function _autoEnable()
        {
            var numChecked = _countChecked();
            $master[propFn]('checked', groupSize === numChecked);
            if (reportTo)
            {
                reportTo(numChecked);
            }
        }

        function _autoDisable()
        {
            $master[propFn]('checked', false);
            if (reportTo)
            {
                reportTo(_countChecked());
            }
        }

        $master.unbind('click.checkAll').bind('click.checkAll', function (e)
        {
            var check_val = e.target.checked;
            $slaves.add($master)[propFn]('checked', check_val);

            if (onMasterClick)
            {
                onMasterClick.apply(this);
            }

            if (reportTo)
            {
                reportTo(check_val ? _countChecked() : 0);
            }
        });


        if (opts.sync)
        {
            $(selector)[offFn]('click.checkAll')[onFn]('click.checkAll', function ()
            {
                this.checked ? _autoEnable() : _autoDisable();

                if (onClick)
                {
                    onClick.apply(this);
                }
            });
        }

        _autoEnable();

        return this;
    };

    $.fn.checkAll.defaults = {sync: true};

    $('.check-all, #check-all').checkAll('input.check-list');

    $('a.tool-remove').on('click', function() {
        event.preventDefault();
        var e = $(this);

        if (e.data('processing')) {
            return;
        }

        //display loading

        //preventing double click
        e.data('processing', true);

        var url = e.attr('href'),
            rel = $('#'+ e.attr('rel'));

        bootbox.confirm("Are you sure?", function(confirmed) {
            if (confirmed) {
                $.postJSON(url, {}, function (response) {
                    if (response.type == 1 && response.id) {
                        for (var i = 0; i < response.ids.length; ++i) {
                            rel.fadeOut(function () {
                                $(this).remove();
                            });
                        }
                    } else if (response.message) {
                        bootbox.alert(response.message, function() {});
                    }
                });
            }
        });

        //end preventing double click
        e.removeData('processing');
    });

}(jQuery));