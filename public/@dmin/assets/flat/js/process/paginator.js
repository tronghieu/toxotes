(function($){
    $.paging = function(e, current_page, total_page, callback, options) {
        var settings = $.extend({
            firstPage: true,
            previousPage: true,
            nextPage : true,
            lastPage: true
        }, options);

        var html = '';
        if(total_page > 1){
            var j = 4;
            html += '<ul class="pagination v2">';
            if(current_page > 1){
                //FIRST PAGE
                if(settings.firstPage) {
                    html += '<li><a class="_paging" data-page="1">&laquo;</a></li>';
                }

                //PREVIOUS PAGE
                if(settings.previousPage){
                    html += '<li><a class="_paging" data-page="' + ( current_page - 1 ) + '">&lsaquo;</a></li>';
                }

                if( current_page > ( j + 1 ) ) {
                    html += '<li><a>...</a></li>';
                }
            }

            for(var i = j; i > 0; i--){
                if(current_page - i > 0){

                    html += '<li>';
                    html += '<a class="_paging" data-page="' + ( current_page - i ) + '">' + ( current_page - i ) + '</a>';
                    html += '</li>';
                }
            }

            html += '<li class="active"><a>' + current_page + '</a></li>';

            for(var i = 1; i <= j; i++){
                if(current_page + i <= total_page){
                    html += '<li>';
                    html += '<a class="_paging" data-page="' + ( current_page + i ) + '">' + ( current_page + i ) + '</a>';
                    html += '</li>';

                }
            }

            if(current_page < total_page){

                if( ( current_page + j ) < total_page ) {
                    html += '<li><a>...</a></li>';
                }

                if(settings.nextPage){
                    html += '<li><a class="_paging" data-page="' + ( current_page + 1 ) + '">&rsaquo;</a></li>';
                }

                if(settings.lastPage){
                    html += '<li><a class="_paging" data-page="' + total_page + '">&raquo;</a></li>';
                }

            }

            html += '</ul>';
        }

        $('#' +e).html(html);

        $("._paging").bind("click",function(){
            callback($(this).data('page'));
        });

        return true;
    }
})(jQuery);