$(document).ready(function() {
    if ("undefined" != typeof Handlebars) {
        User.init();
    }

    $('#_user-search-frm > *').change(function() {
        $('input[name="page"]').val(1);
        User.search();
    });

    $("#_change-pass-btn").click(function() {
        User.changePass();
    });
});

var User = {
    init : function() {
        this.listTmp = Handlebars.compile($("#_user-template").html());
        this.search(true);
    },

    search : function(push_url) {
        var search_data = $('#_user-search-frm').serialize();
        if(push_url) {
            var pageUrl = user_list_url + '?' + search_data;

            if(pageUrl != window.location){
                window.history.pushState({path:pageUrl},'',pageUrl);
            }
        }

        $.ajax({
            url: user_search_url,
            data: search_data,
            success: function(response){
                $("#_user-container").html(User.listTmp(response));
            },
        });
    },

    changePass : function() {
        var current_pass = $("input[name=current_pass]").val(),
            new_pass = $("input[name=new_pass]").val(),
            confirm_pass = $("input[name=confirm_pass]").val(),
            error = [];

        if (current_pass != '' && new_pass != '' && confirm_pass == new_pass) {
            $.ajax({
                url: change_pass_url,
                type: 'POST',
                data: {
                    current_pass : current_pass,
                    new_pass : new_pass,
                    confirm_pass : confirm_pass
                },
                success: function(response){
                    if (response.type) {
                        bootbox.alert(response.message, function() {
                            window.location.href = login_url;
                        });
                    } else {
                        $("#_change-pass-error-ctn").html(response.message)
                            .removeClass('hidden');
                    }
                }
            });
        } else {
            if (current_pass == '') {
                error.push('Current password could not be empty!');
            } else if (new_pass == '') {
                error.push('New password could not be empty!');
            } else if (confirm_pass != new_pass) {
                error.push('Confirm not match!')
            }

            $("#_change-pass-error-ctn").html(error.join("<br>"))
                .removeClass('hidden');
        }
    }
};