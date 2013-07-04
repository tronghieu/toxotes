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
     * @return PostImages[]|null
     */
    public static function getPostImg($postId) {
        return (array) PostImages::findByPostId($postId);
    }
}