$(function() {
    PostForm.init();

    $('.tool-pin, .tool-unpin').on('click', function(e) {
        event.preventDefault();
        var e = $(this);

        if (e.data('processing')) {
            return;
        }

        //preventing double click
        e.data('processing', true);
        var url = e.attr('href');

        $.postJSON(url, {}, function (response) {
            if (response.type == 1) {
                if (e.hasClass('tool-pin')) {
                    e.attr('href', base_url+'/post/unpin?id='+response.id)
                        .removeClass('tool-pin')
                        .addClass('tool-unpin')
                        .html($('<i />', {class : 'icon-star'}));
                } else {
                    e.attr('href', base_url+'/post/pin?id='+response.id)
                        .removeClass('tool-unpin')
                        .addClass('tool-pin')
                        .html($('<i />', {class : 'icon-star-empty'}));
                }
            } else if (response.message) {
                bootbox.alert(response.message, function() {});
            }
        });
    });

    $('#_post-images-ctn').on('click','a._remove-img', function () {
        event.preventDefault();
        var e = $(this);

        if (e.data('processing')) {
            return;
        }

        //preventing double click
        e.data('processing', true);

        var rel = $('#post-img-'+ e.attr('rel'));

        bootbox.confirm("Are you sure?", function(confirmed) {
            if (confirmed) {
                $.post(img_remove_url, {id : e.attr('rel')}, function (response) {
                    if (response.type == 1) {
                        rel.fadeOut();
                        post.images = response.images;
                        PostForm.drawImages(response.images);
                    } else if (response.message) {
                        bootbox.alert(response.message, function() {});
                    }
                });
            } else {
                e.data('processing', false);
            }
        });

        //end preventing double click
        e.removeData('processing');
    }).on('click', 'a._set-main-img', function() {
        var e = $(this);
        if (e.data('processing')) {
            return;
        }
        //preventing double click
        e.data('processing', true);
        $.post(img_set_main_url, {id: e.prop('rel')}, function (response) {
            e.data('processing', false);
            if (response.type == 1) {
                post.images = response.images;
                PostForm.drawImages(response.images);
            } else if (response.message) {
                bootbox.alert(response.message, function() {});
            }
        });
    }).on('click', '._save-img', function() {
        var e = $(this),
            img_id = e.data('img');

        if (e.data('processing')) {
            return;
        }
        //preventing double click
        e.data('processing', true);
        console.log(e, e.data('img'));
        var data = {
            id : img_id,
            ordering : $('#_img-ordering-txt-'+img_id).val(),
            caption: $('#_img-caption-txt-' +img_id).val()
        };
        $.ajax({
            url: img_update_url,
            data: data,
            type: 'POST',
            success: function(response) {
                e.data('processing', false);
                if (response.type == 1) {
                    //nothing
                } else if (response.message) {
                    bootbox.alert(response.message, function() {});
                }
            }
        });
    });

    if ($('#_post-img-upload').length) {
        $("#_post-img-upload").fileupload({
            url: img_upload_url,
            acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
            dataType: 'json',
            formData: {post_id: post.id},
//        start : function (e) {
//            $('#progress .bar').css('width', '0%');
//        },
            done: function (e, data) {
                var result = data.result;

                if (result.type == 1) {
                    post.images.push(result.postImage);
                    PostForm.drawImages(post.images);
                } else {
                    bootbox.alert(result.error.upload.join("<br>"));
                }
            }
//        progressall: function (e, data) {
//            var progress = parseInt(data.loaded / data.total * 100, 10);
//            $('#progress .bar').css(
//                'width',
//                progress + '%'
//            );
//        }
        });

    }

    /*
    if ($('#_post-files-upload').length) {
        $('#_post-files-upload').fileupload({
            url: base_url + '/post_files/upload',
            dataType: 'json',
            formData : {post_id : $('#_post-files-upload').data('postId')},
            done : function (e, data) {
                var result = data.result;
                if (result.type == 1) {
                    var li = $('<li />', {id : '_post-file-' + result.postFile.id})
                    li.append($('<span />').html(result.postFile.file_name))
                        .append($('<div />', {class: 'sub-tool'})
                            .append($('<strong />', {class : 'post-file-download-hits'}).html('Download: ' + result.postFile.hits))
                            .append(' - ')
                            .append($('<a />', {
                                href: base_url + 'post_files/remove?id=' + result.postFile.id,
                                class : '_tool-remove'
                            }).html('Remove'))
                        );

                    $('ul#post-files').append(li).fadeIn();
                }
            }
        });
    }
    */
});

var PostForm = {
    templates : [],
    init: function() {
        var self = this;
        self.templates['images'] = Handlebars.compile($('#_post-img-tmp').html());
        self.drawImages(post.images);
    },

    drawImages: function(images) {
        var self = this;
        $('#_post-images-ctn').html(self.templates['images']({images: images}));
    }
};


