<?php
class ModelUtil {
    /**
     * generate a random token string
     *
     * @param $length
     * @param bool $alphabet
     * @param bool $uppercase
     * @return string
     */
    public static function getToken($length, $alphabet = true, $uppercase = true){
        $token = '';
        $codeAlphabet = '';
        if ($alphabet) {
            $codeAlphabet = "abcdefghijklmnopqrstuvwxyz";

            if ($uppercase) {
                $codeAlphabet .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            }
        }
        $codeAlphabet .= "0123456789";
        for($i=0;$i<$length;$i++){
            $token .= $codeAlphabet[self::cryptoRandSecure(0,strlen($codeAlphabet))];
        }
        return $token;
    }

    /**
     * Get random lucky number
     *
     * @param $length
     * @return string
     */
    public static function getLuckyNumber($length) {
        $token = '';
        $codeAlphabet = "36789";
        for($i=0;$i<$length;$i++){
            $token .= $codeAlphabet[self::cryptoRandSecure(0,strlen($codeAlphabet))];
        }
        return $token;
    }

    public static function cryptoRandSecure($min, $max) {
        $range = $max - $min;
        if ($range < 0) return $min; // not so random...
        $log = log($range, 2);
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd >= $range);
        return $min + $rnd;
    }

    /**
     * Generate random string using SHA1 cryptography
     * @param $length
     * @return string
     */
    public static function randSha1($length) {
        $max = ceil($length / 40);
        $random = '';
        for ($i = 0; $i < $max; ++$i) {
            $random .= sha1(uniqid() . mt_rand());
        }
        return substr($random, 0, $length);
    }

    /**
     * Generate random string using MD5 cryptography
     * @param $length
     * @return string
     */
    public static function randMd5($length) {
        $max = ceil($length / 32);
        $random = '';
        for ($i = 0; $i < $max; ++$i) {
            $random .= md5(uniqid() .mt_rand());
        }
        return substr($random, 0, $length);
    }
} 