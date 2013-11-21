<?php
return array(
    'site_url' => 'http://localhost/toxotes/public/',
    'recaptcha_public_key' => '6LcKneoSAAAAACQaoYXcJS5VByjfTHjrlCbhE9fL',
    'i18n' => array(
        'enable' => true,
        'default_fallback' => array('en'),
        'default_locale' => 'en-US',
        'resource' => array(
            'vi-VN' => array(
                ROOT_PATH .'/resource/languages/vi-VN/common.php',
            )
        )
    ),
    'upload_allow' => '.psd, .pdf, .xls, .ppt, .gtar, .gz, .tar, .tgz, .zip, .rar, .rev, .mp3, .ram, .wav, .bmp, .gif, .jpeg, .jpg, .jpe, .png, .txt, .text, .rtx, .xml, .xsl, .mpeg, .mpg, .mpe, .mov, .avi, .movie, .doc, .docx, .xlsx, .word, .xl'
);