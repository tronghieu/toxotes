<?php 
/**
 * Posts
 * @version		$Id$
 * @package		Model

 */

require_once dirname(__FILE__) .'/Base/PostsBase.php';
class Posts extends \PostsBase {
    public function validationRules() {
        self::$_validate['title'][] = array(
            'name' => 'Require',
            'message' => "Title can not be blank!");

        self::$_validate['term_id'][] = array(
            'name' => 'MinValue',
            'value' => '1',
            'message' => 'Post term is required!',
        );

        self::$_validate['taxonomy'][] = array(
            'name' => 'Require',
            'message' => "Taxonomy can not be blank!");
    }


    /**
     * init
     */
    public function init() {
        parent::init();
        $this->attachBehavior(
            'TimeStamp', new \Flywheel\Model\Behavior\TimeStamp(), array(
                'create_attr' => 'created_time',
                'modify_attr' => 'modified_time'
            )
        );
    }

    /**
     * Display main img
     * @param null $dimension
     * @return string
     */
    public function displayMainImg($dimension = null) {
        $mainImg = \PostPeer::getPostMainImg($this->getId());
        if (!$mainImg) {
            return '';
        }

        return '.' .$mainImg->getPath();
    }

    /**
     * @param array $param
     * @return string
     */
    public function displayThumbImage($param = array()) {
        $mainImg = \PostPeer::getPostMainImg($this->getId());
        if (!$mainImg) {
            return '';
        }

        $file = $mainImg->getPath();
        $temp = '';

        foreach($param as $p=>$v) {
            $temp .= $p .'[' .$v .']';
        }

        return './thumb/' .$mainImg->getPath() .'?resize=' .$temp;
    }

    /**
     * @return null|\PostImages
     */
    public function getMainImg() {
        return $mainImg = \PostPeer::getPostMainImg($this->getId());
    }

    /**
     * @param $property
     * @return \PostProperty
     */
    public function getProperty($property)
    {
        return \PostProperty::retrieveByPropertyAndPostId($property, $this->getId());
    }

    /**
     * @return \PostAttachments[]
     */
    public function getAttachments() {
        return \PostAttachments::findByPostId($this->getId());
    }

    /**
     * check post's draft
     * @return bool
     */
    public function isDraft()
    {
        return (bool) $this->getIsDraft();
    }

    /**
     * Overwrite
     * @return \Flywheel\Event\Event
     */
    protected function _beforeSave() {
        if (!$this->getSlug() && $this->getTitle()) {
            $this->setSlug(\Flywheel\Util\Slugify::filter($this->getTitle()));
        }

        return parent::_beforeSave();
    }

    protected function _afterDelete() {
        parent::_afterDelete();
        \PostImages::write()->delete(PostImages::getTableName())
            ->where('`post_id`=:post_id')
            ->setParameter(':post_id', $this->getId(), \PDO::PARAM_INT)
            ->execute();

        \PostCustomFields::write()->delete(PostCustomFields::getTableName())
            ->where('`post_id`=:post_id')
            ->setParameter(':post_id', $this->getId(), \PDO::PARAM_INT)
            ->execute();

        \PostAttachments::write()->delete(PostAttachments::getTableName())
            ->where('`post_id`=:post_id')
            ->setParameter(':post_id', $this->getId(), \PDO::PARAM_INT)
            ->execute();

        \PostProperty::write()->delete(PostProperty::getTableName())
            ->where('`post_id`=:post_id')
            ->setParameter(':post_id', $this->getId(), \PDO::PARAM_INT)
            ->execute();
    }
}