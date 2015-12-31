$(document).ready(function() {
    if ("undefined" != typeof Handlebars) {
        DonateHistory.init();
    }

    $('#_dh-search-frm > *').change(function() {
        $('input[name="page"]').val(1);
        DonateHistory.search(true);
    });
});

DonateHistory = {
    init : function() {
        this.listTmp = Handlebars.compile($("#_dh-list-tmp").html());
        this.search(false);
    },

    search : function(push_url) {
        var self = this,
            search_data = $('#_dh-search-frm').serialize();
        if(push_url) {
            var pageUrl = dh_list_url + '?' + search_data;

            if(pageUrl != window.location){
                window.history.pushState({path:pageUrl},'',pageUrl);
            }
        }

        $.ajax({
            url: dh_list_url,
            data: search_data,
            success: function(response){
                $("#_dh-list-ctn").html(self.listTmp(response));
                $.paging('paging', response.current_page, response.total_page, function(page) {
                    $('input[name="page"]').val(page);
                    self.search(true);
                });
            }
        });
    }
};