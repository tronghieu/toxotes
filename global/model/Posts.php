<?php 
/**
 * Items
 *  This class has been auto-generated at 15/04/2013 10:50:21
 * @version		$Id$
 * @package		Model

 */

use Flywheel\Db\Type\DateTime;

require_once dirname(__FILE__) . '/Base/PostsBase.php';
class Posts extends \PostsBase {
    protected function _beforeSave() {
        if ($this->isNew()) {
            $this->setCreatedTime(new DateTime());
        }

        $this->setModifiedTime(new DateTime());
    }

    protected function _afterDelete() {
        parent::_afterDelete();
        PostImages::write()->delete(PostImages::getTableName())
            ->where('`post_id`=:post_id')
            ->setParameter(':post_id', $this->getId(), \PDO::PARAM_INT)
            ->execute();

        PostCustomFields::write()->delete(PostCustomFields::getTableName())
            ->where('`post_id`=:post_id')
            ->setParameter(':post_id', $this->getId(), \PDO::PARAM_INT)
            ->execute();

        PostAttachments::write()->delete(PostAttachments::getTableName())
            ->where('`post_id`=:post_id')
            ->setParameter(':post_id', $this->getId(), \PDO::PARAM_INT)
            ->execute();

        PostProperty::write()->delete(PostProperty::getTableName())
            ->where('`post_id`=:post_id')
            ->setParameter(':post_id', $this->getId(), \PDO::PARAM_INT)
            ->execute();
    }
}