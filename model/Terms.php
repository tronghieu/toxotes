<?php 
/**
 * Terms
 * @version		$Id$
 * @package		Model

 */

use Flywheel\Model\Behavior\NestedSet;
use Flywheel\Util\Slugify;

require_once dirname(__FILE__) .'/Base/TermsBase.php';

/**
 * Class Terms
 *
 * Nested Set Behavior API List
 *
 * @method int getLeftValue()
 * @method void setLeftValue()
 * @method int getRightValue()
 * @method void setRightValue()
 * @method mixed getScopeValue(bool $withQuote)
 * @method void setScopeValue(int $scope)
 * @method int getLevelValue()
 * @method void setLevelValue()
 * @method Terms makeRoot()
 * @method boolean isInTree()
 * @method boolean isRoot()
 * @method boolean isLeaf()
 * @method boolean isDescendantOf($parent)
 * @method boolean isAncestorOf($child)
 * @method boolean hasParent()
 * @method boolean hasPrevSibling(\Flywheel\Db\Query $query = null)
 * @method boolean hasNextSibling(\Flywheel\Db\Query $query = null)
 * @method boolean hasChildren()
 * @method int countChildren(\Flywheel\Db\Query $query = null)
 * @method int countDescendants(\Flywheel\Db\Query $query = null)
 * @method null|Terms getParent()
 * @method bool|Terms getPrevSibling(\Flywheel\Db\Query $query = null)
 * @method bool|Terms getNextSibling(\Flywheel\Db\Query $query = null)
 * @method array getChildren(\Flywheel\Db\Query $query = null)
 * @method null|Terms getFirstChild(\Flywheel\Db\Query $query = null)
 * @method null|Terms getLastChild(\Flywheel\Db\Query $query = null)
 * @method \Terms[] getSiblings($query = null)
 * @method \Terms[] getDescendants($query = null)
 * @method Terms[] getBranch($query = null)
 * @method Terms[] getAncestors($query = null)
 * @method Terms addChild($node)
 * @method Terms insertAsFirstChildOf($node)
 * @method Terms insertAsLastChildOf($node)
 * @method Terms insertAsPrevSiblingOf($node)
 * @method Terms insertAsNextSiblingOf($node)
 * @method Terms moveToFirstChildOf($node)
 * @method Terms moveToLastChildOf($node)
 * @method Terms moveToPrevSiblingOf($node)
 * @method Terms moveToNextSiblingOf($node)
 * @method int deleteDescendants()
 * @method void shiftRLValues($delta, $first, $last = null, $scope = null)
 * @method void shiftLevel($delta, $first, $last = null, $scope = null)
 * @method void setNegativeScope($scope)
 * @method Terms findRoot($scope = null)
 * @method Terms[] findRoots()
 * @method boolean isNodeValid()
 * @method void makeRoomForLeaf(int $level, $scope = null)
 */
class Terms extends \TermsBase {
    const STATUS_ACTIVE = 'ACTIVE',
        STATUS_INACTIVE = 'INACTIVE';

    /**
     * @var TermProperty[]
     */
    protected $_properties;

    public function init() {
        parent::init();
        $this->attachBehavior('NestedSet', new NestedSet(), array(
            'left_attr' => 'lft',
            'right_attr' => 'rgt',
            'level_attr' => 'lvl',
            'scope_attr' => 'scope',
        ));
    }

    public function validationRules() {
        self::$_validate['name'][] = array(
            'name' => 'Require',
            'message' => 'name can not be blank!',
        );

        self::$_validate['taxonomy'][] = array(
            'name' => 'Require',
            'message' => 'taxonomy can not be blank!',
        );

    }

    /**
     * @param null $scope
     * @return Terms
     */
    public static function retrieveRoot($scope = null) {
        $root = new \Terms();
        $root = $root->findRoot($scope);
        if (!$root) {
            $root = new \Terms();
            $root->scope = $scope;
            $root->taxonomy = $scope;
            $root->name = 'Root of ' .$scope;
            $root->makeRoot();
            $root->save();
        }

        return $root;
    }

    /**
     * check term has items @see Terms::countPosts(countPosts;
     * @return bool
     */
    public function hasPosts() {
        return (boolean) $this->countPosts();
    }

    /**
     * @return int
     */
    public function countPosts() {
        return Posts::read()->where('`term_id` = ?')
            ->count('id')
            ->setParameter(1, $this->getId(), \PDO::PARAM_INT)
            ->execute();
    }

    /**
     * get Term's properties
     *
     * @return \TermProperty[]
     */
    public function getProperties() {
        return \TermProperty::getTermProperties($this->id);
    }

    /**
     * @param $property
     * @return null|\TermProperty
     */
    public function getProperty($property) {
        return \TermProperty::getPropertyObj($this->id, $property);
    }

    /** OVERWRITE METHOD */
    protected function _beforeSave() {
        $this->setSlug(Slugify::filter($this->getName()));
        parent::_beforeSave();
    }

    protected function _afterDelete() {
        TermProperty::write()->delete(TermProperty::getTableName())
            ->where('term_id = ' .$this->getId())
            ->execute();
        parent::_afterDelete();
    }

    /**
     * Change all children status
     * @param string $status 'ACTIVE' | 'INACTIVE'
     * @throws Flywheel\Db\Exception
     * @return bool
     */
    public function changeDescendantsStatus($status) {
        if ($status != self::STATUS_ACTIVE && $status != self::STATUS_INACTIVE) {
            throw new \Flywheel\Db\Exception("Status's value {$status} is not allowed!");
        }

        if (!$this->hasChildren()) {
            return true; //not need
        }

        /** @var \Terms[] $descendants */
        $descendants = $this->getDescendants();
        $ids = [];

        if (!empty($descendants) && is_array($descendants)) {
            foreach($descendants as $d) {
                $ids[] = $d->getId();
            }
        }
        if (!empty($ids)) {
            $result = self::write()
                ->update(self::$_tableName, 'c')
                ->set('c.status', '?')
                ->setParameter(1, $status, \PDO::PARAM_STR)
                ->where('id IN (' .implode(',', $ids) .')')
                ->execute();
            self::clearPool();
            return true;
        }

        return true;
    }
}