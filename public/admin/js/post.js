$(function() {
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

    $('a._post-img-remove').on('click', function () {
        event.preventDefault();

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
                $.postJSON(url, {}, function (response) {
                    if (response.type == 1) {
                        rel.fadeOut(function () {
                            $(this).remove();
                        });
                        if (response.otherMain) {
                            $('img.main-img').attr('src', './../' +response.otherMain.path);
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

    if ($('#post-img-upload').length) {
        $("#post-img-upload").fileupload({
            url: base_url + '/post_img/upload',
            dataType: 'json',
            formData : {post_id : $("#post-img-upload").data('postId')},
//        start : function (e) {
//            $('#progress .bar').css('width', '0%');
//        },
            done: function (e, data) {
                var result = data.result;

                if (result.type == 1) {
                    var li = $('<li />' , {
                        id : 'post-img-' + result.postImage.id,
                        data: {postId : result.postImage.post_id}
                    });
                    li.append($('<a />', {
                        href : '#'
                    })
                        .append($('<img />', {
                            src: './../' + result.postImage.path,
                            width: 90
                        })
                        )
                    );

                    li.append($('<div />', {
                        class : 'extras'
                    })
                        .append($('<div />', {
                            class : 'extras-inner'
                        })
                            .append($('<a />', {
                                class: '_post-im-make-star',
                                href: base_url + '/post_img/make_star?id=' + result.postImage.id
                            })
                                .append($('<i />', {class : 'icon-star'}))
                            )
                            .append($('<a />', {
                                class: '_post-img-remove',
                                rel: 'post-img-' + result.postImage.id,
                                href: base_url + '/post_img/remove?id=' + result.postImage.id
                            })
                                .append($('<i />', {class: 'icon-trash'}))
                            )
                        )
                    );

                    if (result.postImage.is_main) {
                        $('#_main-img-preview')
                            .attr({'src': './../' +result.postImage.path})
                            .removeClass('no-img')
                            .addClass('main-img');
                    }

                    $('ul.gallery').append(li).fadeIn('slow');
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
});


