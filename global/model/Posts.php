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
    public function validationRules() {
        self::$_validate['title'][] = array(
            'name' => 'Require',
            'message' => "Title can not be blank!");

        self::$_validate['taxonomy'][] = array(
            'name' => 'Require',
            'message' => "Taxonomy can not be blank!");
    }

    protected function _beforeSave() {
        if ($this->isNew()) {
            $this->setCreatedTime(new DateTime());
        }

        if (!$this->getSlug() && $this->getTitle()) {
            $this->setSlug(\Flywheel\Util\Slugify::filter($this->getTitle()));
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