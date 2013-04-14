<?php
class ModelPeer
{
    public static function generateUk($prefix) {
        $name = $prefix .date('my', time());
        switch ($prefix) {
            case 'ACC':
                $name .= strtoupper(self::randCrc32b(8));
                break;
            case 'DEP':
            case 'WIT':
                $name .= strtoupper(self::randCrc32b(16));
                break;
            case 'TRA':
            case 'COS': //cut_off_session
                $name .= strtoupper(self::randMd5(32));
                break;
            default:
                $name .= self::randMd5(32);
                break;
        }
        return $name;
    }

    public static function generateCrc($om, $fields) {
        $attributes = $om->getAttributes($fields);
        uksort($attributes, 'strcmp');
        $values = '{' .implode('}{', array_values($attributes)) .'}';

        //get salt string
        if ($om->isNew()) {
            //generate new salt
            $salt = md5(uniqid() .time() .microtime());
        } else {
            $salt = substr($om->{$om->checksumFieldName}, 32, 32);
        }

        return md5($values .$salt).$salt;
    }

    public static function checksumCompare($om, $fields) {
        return self::generateCrc($om, $fields) == $om->{$om->checksumFieldName};
    }

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
