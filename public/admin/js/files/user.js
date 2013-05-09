$(function () {
    $('a.tool-remove').on('click', function() {
        event.preventDefault();
        var e = $(this);

        if (e.data('processing')) {
            return;
        }

        //display loading

        //preventing double click
        e.data('processing', true);

        var id = e.data('id'),
            url = e.attr('href');

        bootbox.confirm("Are you sure?", function(confirmed) {
            if (confirmed) {
                $.postJSON(url, {'id' : id}, function (response) {
                    if (response.type == 1 && response.ids.length > 0) {
                        for (var i = 0; i < response.ids.length; ++i) {
                            $('tr#user-row-' + response.ids[i]).fadeOut(function () {
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
});