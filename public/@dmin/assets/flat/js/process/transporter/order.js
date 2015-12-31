$(document).ready(function() {
    if ("undefined" != typeof Handlebars) {
        Transporter.Order.init();
    }

    $('#_order-search-frm > *').change(function() {
        $('input[name="page"]').val(1);
        Transporter.Order.search();
    });
});

Transporter.Order = {
    init : function() {
        this.listTmp = Handlebars.compile($("#_orders-list-tmp").html());
        this.search(false);
    },

    search : function(push_url) {
        var self = this,
            search_data = $('#_order-search-frm').serialize();
        if(push_url) {
            var pageUrl = order_list_url + '?' + search_data;

            if(pageUrl != window.location){
                window.history.pushState({path:pageUrl},'',pageUrl);
            }
        }

        $.ajax({
            url: order_list_url,
            data: search_data,
            success: function(response){
                $("#_orders-list-ctn").html(self.listTmp(response));
                $.paging('paging', response.current_page, response.total_page, function(page) {
                    $('input[name="page"]').val(page);
                    self.search(true);
                });
            }
        });
    }
};