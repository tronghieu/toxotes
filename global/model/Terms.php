<?php

use Flywheel\Model\Behavior\NestedSet;

require_once dirname(__FILE__) .'/Base/TermsBase.php';

/**
 * Terms
 *  This class has been auto-generated at 15/04/2013 10:50:21
 * @version		$Id$
 * @package		Model
 *
 * Nested Set Behavior
 * API List
 *
 * @method int getLeftValue()
 * @method void setLeftValue()
 * @method int getRightValue()
 * @method void setRightValue()
 * @method mixed getScopeValue(bool $withQuote)
 * @method void setScopeValue(int $scope)
 * @method int getLevel()
 * @method void setLevel()
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
 * @method Terms[] getSiblings($query = null)
 * @method Terms[] getDescendants($query = null)
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
     * get Term's properties
     *
     * @return TermProperty[]
     */
    public function getProperties() {
        if (null == $this->_properties) {
            $this->_properties = TermProperty::read()
                                ->where('`term_id`=?')
                                ->orderBy('ordering')
                                ->setParameter(1, $this->id, \PDO::PARAM_INT)
                                ->execute()
                                ->fetchAll(\PDO::FETCH_CLASS, 'TermProperty', array(null, false));
        }

        return $this->_properties;
    }

    public static function retrieveRoot($scope = null) {
        $root = new Terms();
        $root = $root->findRoot($scope);
        if (!$root) {
            $root = new Terms();
            $root->scope = $scope;
            $root->taxonomy = $scope;
            $root->name = 'Root of ' .$scope;
            $root->makeRoot();
            $root->save();
        }

        return $root;
    }

    /**
     * check term has items @see Terms::countItems();
     * @return bool
     */
    public function hasItems() {
        return (boolean) $this->countItems();
    }

    public function countItems() {
        return Items::read()->where('`term_id` = ?')
                        ->count('id')
                        ->setParameter(1, $this->getId(), \PDO::PARAM_INT)
                        ->execute();
    }

    protected function _beforeSave() {
        $this->setSlug($this->getName());
    }
}