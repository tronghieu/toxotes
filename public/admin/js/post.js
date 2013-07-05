$(function() {
    $("#post-img-upload").fileupload({
        url: base_url + '/post_img/upload',
        dataType: 'json',
        formData : {'post_id' : $(this).data('postId')},
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('<p/>').text(file.name).appendTo('#files');
            });
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .bar').css(
                'width',
                progress + '%'
            );
        }
    });
});
