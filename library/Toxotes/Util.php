<?php
namespace Toxotes;

class Util {
    /**
     * @param $email
     * @param int $size
     * @return string
     */
    public static function gravatar($email, $size = 40) {
        return 'http://www.gravatar.com/avatar/' . md5(strtolower(trim($email))) . "?s={$size}";
    }
} 