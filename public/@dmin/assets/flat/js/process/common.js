function random_string(length, special_char) {
    if ("undefined" != typeof length) {
        length = 8;
    }

    if ("undefined" != typeof special_char) {
        special_char = true;
    }

    var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
    if (special_char) {
        chars += '!@#$%^&*()_+';
    }
    var random_string = '';
    for (var i=0; i< length; i++) {
        var rnum = Math.floor(Math.random() * chars.length);
        random_string += chars.substring(rnum,rnum+1);
    }

    return random_string;
}

if ("undefined" != typeof Handlebars) {
    Handlebars.registerHelper('date', function(datetime, options) {
        var dateSplit = datetime.split(/[- :]/);
        if (dateSplit[0] == '0000' || isNaN(dateSplit[5])) {
            return '';
        }

        var date = new Date(dateSplit[0], dateSplit[1]-1, dateSplit[2], dateSplit[3], dateSplit[4], dateSplit[5]),
            today = new Date(),
            day = parseInt(date.getDate()),
            month = parseInt(date.getMonth()) + 1,
            hours = parseInt(date.getHours()),
            minute = parseInt(date.getMinutes());

        month = (month < 10)? '0' +month.toString() : month.toString();
        day = (day < 10)? '0' +day.toString() : day.toString();
        hours = (hours < 10)? '0' +hours.toString() : hours.toString();
        minute = (minute < 10)? '0' +minute.toString() : minute.toString();

        if (date.getFullYear() == today.getFullYear()) {
            return hours +':' + minute +' ' + day +'/' +month;
        } else {
            return day + '/' +month +'/' +date.getFullYear();
        }
    });

    Handlebars.registerHelper('full_date', function(datetime, options) {
        var dateSplit = datetime.split(/[- :]/);
        if (dateSplit[0] == '0000' || isNaN(dateSplit[5])) {
            return '';
        }

        var date = new Date(dateSplit[0], dateSplit[1]-1, dateSplit[2], dateSplit[3], dateSplit[4], dateSplit[5]),
            today = new Date(),
            day = parseInt(date.getDate()),
            month = parseInt(date.getMonth()) + 1,
            hours = parseInt(date.getHours()),
            minute = parseInt(date.getMinutes());

        month = (month < 10)? '0' +month.toString() : month.toString();
        day = (day < 10)? '0' +day.toString() : day.toString();
        hours = (hours < 10)? '0' +hours.toString() : hours.toString();
        minute = (minute < 10)? '0' +minute.toString() : minute.toString();

        return hours +':' + minute +' ' +day + '/' +month +'/' +date.getFullYear();
    });

    Handlebars.registerHelper("currency", function(amount, symbol, options) {
        options = $.extend({
            sup: true,
            thousand_sep: '.',
            thousand_k: false
        }, options);

        amount = amount/1000;
        symbol= 'K';

        if (options.thousand_sep) {
            amount = amount.toString();
            var pattern = /(-?\d+)(\d{3})/;
            while (pattern.test(amount)) {
                amount = amount.replace(pattern, "$1" +options.thousand_sep +"$2");
            }
        }
        if (options.sup) {
            symbol = "<sup>" +symbol +"</sup>";
        }

        return new Handlebars.SafeString(amount +symbol);
    });

    Handlebars.registerHelper("math", function(lvalue, operator, rvalue, options) {
        lvalue = parseFloat(lvalue);
        rvalue = parseFloat(rvalue);

        return {
            "+": lvalue + rvalue,
            "-": lvalue - rvalue,
            "*": lvalue * rvalue,
            "/": lvalue / rvalue,
            "%": lvalue % rvalue
        }[operator];
    });

    Handlebars.registerHelper('ifCond', function (v1, operator, v2, options) {
        switch (operator) {
            case '==':
                return (v1 == v2) ? options.fn(this) : options.inverse(this);
            case '===':
                return (v1 === v2) ? options.fn(this) : options.inverse(this);
            case '!=':
                return (v1 != v2) ? options.fn(this) : options.inverse(this);
            case '!==':
                return (v1 !== v2) ? options.fn(this) : options.inverse(this);
            case '<':
                return (v1 < v2) ? options.fn(this) : options.inverse(this);
            case '<=':
                return (v1 <= v2) ? options.fn(this) : options.inverse(this);
            case '>':
                return (v1 > v2) ? options.fn(this) : options.inverse(this);
            case '>=':
                return (v1 >= v2) ? options.fn(this) : options.inverse(this);
            case '&&':
                return (v1 && v2) ? options.fn(this) : options.inverse(this);
            case '||':
                return (v1 || v2) ? options.fn(this) : options.inverse(this);
            default:
                return options.inverse(this);
        }
    });

    Handlebars.registerHelper('for', function(from, to, incr, block) {
        var accum = '';
        for(var i = from; i < to; i += incr)
            accum += block.fn(i);
        return accum;
    });

    Handlebars.registerHelper("debug", function(optionalValue) {
        console.log("Current Context");
        //console.log(this);

        if (optionalValue) {
            console.log("Value");
            console.log(optionalValue);
        }
    });

    Handlebars.registerHelper('console_log', function(value) {
        console.log(value);
    });
}

$(function() {
    //Ajax setup
    $.ajaxSetup({
        beforeSend:function(){
            if ("undefined" != typeof NProgress) {
                NProgress.start();
            }
        },
        complete:function(){
            if ("undefined" != typeof NProgress) {
                NProgress.done();
            }
        }
    });

    //Checkall
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
                $.post(url, {}, function (response) {
                    if (response.type == 1) {
                        rel.fadeOut(function () {
                            $(this).remove();
                        });
                    } else if (response.message) {
                        bootbox.alert(response.message, function() {});
                    }
                });
            }
        });

        //end preventing double click
        e.removeData('processing');
    });

    //Implement
    $('.check-all, #check-all').checkAll('input.check-list');

    //Auto numeric
    $('input.autoNumeric').autoNumeric({ aPad: false, mDec: 9, aSep : '.', aDec: ',' });
}(jQuery));

function media_upload(file, editor, welEditable) {
    var data = new FormData();
    data.append("file_upload", file);
    $.ajax({
        data: data,
        type: "POST",
        url: media_upload_url,
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
            editor.insertImage(welEditable, response.image.url);
        }
    });
}
