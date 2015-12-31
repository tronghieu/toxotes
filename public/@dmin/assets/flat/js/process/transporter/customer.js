$(document).ready(function() {
    if ("undefined" != typeof Handlebars) {
        Transporter.Customer.init();
    }

    $('#_cus-search-frm > *').change(function() {
        $('input[name="page"]').val(1);
        Transporter.Customer.search();
    });
});

Transporter.Customer = {
    init : function() {
        this.listTmp = Handlebars.compile($("#_cus-list-tmp").html());
        this.search(true);
    },

    search : function(push_url) {
        var self = this,
            search_data = $('#_cus-search-frm').serialize();
        if(push_url) {
            var pageUrl = cus_list_url + '?' + search_data;

            if(pageUrl != window.location){
                window.history.pushState({path:pageUrl},'',pageUrl);
            }
        }

        $.ajax({
            url: cus_list_url,
            data: search_data,
            success: function(response){
                $("#_cus-list-ctn").html(self.listTmp(response));
                $.paging('paging', response.current_page, response.total_page, function(page) {
                    $('input[name="page"]').val(page);
                    self.search(true);
                });
            }
        });
    }
};