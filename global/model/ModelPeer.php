<?php
class ModelPeer {

    public static function randCrc32b($length) {
        $max = ceil($length / 8);
        $random = '';
        for ($i = 0; $i < $max; ++$i) {
            $random .= hash('crc32b' ,uniqid() .mt_rand());
        }
        return substr($random, 0, $length);
    }

    public static function randMd5($length) {
        $max = ceil($length / 32);
        $random = '';
        for ($i = 0; $i < $max; ++$i) {
            $random .= md5(uniqid() .mt_rand());
        }
        return substr($random, 0, $length);
    }

    public static function randSha1($length) {
        $max = ceil($length / 40);
        $random = '';
        for ($i = 0; $i < $max; ++$i) {
            $random .= sha1(uniqid() .mt_rand());
        }
        return substr($random, 0, $length);
    }
}
