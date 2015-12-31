$(document).ready(function() {
    if ("undefined" != typeof Handlebars) {
        Character.init();
    }

    $('#_char-search-frm > *').change(function() {
        $('input[name="page"]').val(1);
        Character.search();
    });

    $(document).on('click', 'a._btn-qsave', function() {
        var e = $(this),
            input = $('input#' +e.prop('rel')),
            name = input.prop('name'),
            value = input.val(),
            data = {};
        if (e.data('disabled')) {
            return;
        }

        e.data('disabled', true)
            .addClass('disabled');
        data[name] = value;
        data.charguid = input.data('charguid');
        data.server = input.data('server');

        Character.update(data, function (res) {
            e.html('<i class="fa fa-check"></i>');
            window.setTimeout(function() {
                e.html('<i class="fa fa-save"></i>')
                    .removeClass('disabled')
                    .data('disabled', true);
            }, 3000);
        });

    });
});

var Character = {
    init : function() {
        this.listTmp = Handlebars.compile($("#_char-template").html());
        this.search(true);
    },

    search : function(push_url) {
        var self = this;
        var search_data = $('#_char-search-frm').serialize();
        if(push_url) {
            var pageUrl = char_list_url + '?' + search_data;

            if(pageUrl != window.location){
                window.history.pushState({path:pageUrl},'',pageUrl);
            }
        }

        $.ajax({
            url: char_search_url,
            data: search_data,
            success: function(response){
                $("#_char-container").html(Character.listTmp(response));
                $('input.autoNumeric')
                    .on("click", function () {
                        $(this).select();
                    })
                    .autoNumeric({ aPad: false, mDec: 9, aSep : '.', aDec: ',' });

                $.paging('paging', response.page, response.total_page, function(page) {
                    $('input[name="page"]').val(page);
                    self.search(true);
                });
            }
        });
    },

    update : function(form_data, callback) {
        $.post(char_update_url, form_data, function(res) {
            if (!res.type) {
                bootbox.alert(res.message);
            } else {
                callback(res);
            }
        })
    }
};