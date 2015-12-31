(function () {
    $("#_item-images-ctn").on('click', 'a._set-main-img', function() {
        var e = $(this);
        $.ajax({
            url: set_main_img_url,
            data: {
                file_name : e.prop('rel'),
                item_id: item.id
            },
            type: 'POST',
            success: function(response) {
                if (!response.type) {
                    bootbox.alert(response.message);
                } else {
                    item.imgs = response.images;
                    Items.Form.drawImages();
                }
            }
        })
    }).on('click', 'a._remove-img', function() {
        var e = $(this);
        $.ajax({
            url: remove_img_url,
            data: {
                file_name : e.prop('rel'),
                item_id: item.id
            },
            type: 'POST',
            success: function(response) {
                if (!response.type) {
                    bootbox.alert(response.message);
                } else {
                    item.imgs = response.images;
                    Items.Form.drawImages();
                }
            }
        })
    });
})(jQuery);

Items = {
    templates: {},

    init: function() {
        var self = this;
        self.templates['list_items'] = Handlebars.compile($("#_item-list-tmp").html());
        self.search(false);

        $('#_items-search-frm > *').change(function() {
            $('input[name="page"]').val(1);
            self.search(true);
        });
    },

    search : function(push_url) {
        var self = this,
            search_data = $('#_items-search-frm').serialize();
        if(push_url) {
            var pageUrl = items_list_url + '?' + search_data;

            if(pageUrl != window.location){
                window.history.pushState({path:pageUrl},'',pageUrl);
            }
        }

        $.ajax({
            url: items_list_url,
            data: search_data,
            success: function(response){
                $("#_items-list-ctn").html(self.templates['list_items'](response));
                $.paging('paging', response.current_page, response.total_page, function(page) {
                    $('input[name="page"]').val(page);
                    self.search(true);
                });
            }
        });
    }
};

Items.Form = {
    init: function() {
        var self = this;
        Items.templates['images'] = Handlebars.compile($("#_item-images-tmp").html());
        self.initUpload();
        self.drawImages();
    },

    drawImages: function() {
        $('#_item-images-ctn').html(Items.templates['images'](item));
        $('#_item-imgs').val(JSON.stringify(item.imgs));
    },

    initUpload: function() {
        var self = this;
        $("#_item-img-upload").fileupload({
            url: upload_url,
            acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
            dataType: 'json',
            formData: {item_id: item.id},
            /*start : function (e) {
                $('#progress .bar').css('width', '0%');
            },*/
            done: function (e, data) {
                var result = data.result;

                if (result.type == 1) {
                    if (item.imgs.length == 0) {
                        item.imgs = {};
                    }
                    item.imgs[result.image.file_name] = result.image;
                    self.drawImages();
                } else {
                    bootbox.alert(result.error.upload.join("<br>"));
                }
            }
            /*progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .bar').css(
                    'width',
                    progress + '%'
                );
            }*/
        });
    },
};