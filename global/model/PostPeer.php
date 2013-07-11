<?php

class PostPeer {
    /**
     * @param $postId
     * @return null|PostImages
     */
    public static function getPostMainImg($postId) {
        return PostImages::findOneByPostIdAndIsMain($postId, true);
    }

    /**
     * @param $postId
     * @return PostImages[] | null
     */
    public static function getPostImg($postId) {
        return (array) PostImages::findByPostId($postId);
    }

    /**
     * @param $postId
     * @return PostAttachments[] | null
     */
    public static function getPostAttachments($postId) {
        return (array) PostAttachments::findByPostId($postId);
    }

    /**
     * @param $postId
     * @param bool $assoc
     * @return PostProperty[] | null
     */
    public static function getPostProperties($postId, $assoc = false) {
        /** @var PostProperty $properties */
        $properties =  (array) PostProperty::findByPostId($postId);
        if (!$assoc) {
            return $properties;
        }

        $p = array();
        foreach($properties as $property) {
            $p[$property->getProperty()] = $property->getValue();
        }
    }
}