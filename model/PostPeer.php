<?php

class PostPeer {
    protected static $_caches = array();
    /**
     * @param $postId
     * @return null|\PostImages
     */
    public static function getPostMainImg($postId) {
        return \PostImages::findOneByPostIdAndIsMain($postId, true);
    }

    /**
     * @param $postId
     * @return \PostImages[] | null
     */
    public static function getPostImg($postId) {
        return \PostImages::select()
            ->where('`post_id` = :post_id')
            ->setParameter(':post_id', $postId, \PDO::PARAM_INT)
            ->orderBy('ordering')
            ->execute();
    }

    /**
     * @param $postId
     * @return \PostAttachments[] | null
     */
    public static function getPostAttachments($postId) {
        return (array) \PostAttachments::findByPostId($postId);
    }

    /**
     * @param $postId
     * @param bool $assoc
     * @return \PostProperty[] | null
     */
    public static function getPostProperties($postId, $assoc = true) {
        /** @var \PostProperty[] $properties */
        $properties =  (array) PostProperty::select()->where('`post_id` = :post_id')
                                ->setParameter(':post_id' ,$postId, \PDO::PARAM_INT)
                                ->orderBy('ordering')
                                ->execute();
        if (empty($properties)) {
            return $properties;
        }

        if (!$assoc) {
            return $properties;
        }

        $p = array();
        foreach($properties as $property) {
            $p[$property->getProperty()] = $property;
        }

        return $p;
    }
}