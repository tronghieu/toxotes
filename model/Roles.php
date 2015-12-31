<?php 
/**
 * Roles
 * @version		$Id$
 * @package		Model

 */

use Flywheel\Model\Behavior\NestedSet;

require_once dirname(__FILE__) .'/Base/RolesBase.php';
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
 * @method \Roles makeRoot()
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
 * @method null|\Roles getParent()
 * @method bool|\Roles getPrevSibling(\Flywheel\Db\Query $query = null)
 * @method bool|\Roles getNextSibling(\Flywheel\Db\Query $query = null)
 * @method array getChildren(\Flywheel\Db\Query $query = null)
 * @method null|\Roles getFirstChild(\Flywheel\Db\Query $query = null)
 * @method null|\Roles getLastChild(\Flywheel\Db\Query $query = null)
 * @method \Roles[] getSiblings($query = null)
 * @method \Roles[] getDescendants($query = null)
 * @method \Roles[] getBranch($query = null)
 * @method \Roles[] getAncestors($query = null)
 * @method \Roles addChild($node)
 * @method \Roles insertAsFirstChildOf($node)
 * @method \Roles insertAsLastChildOf($node)
 * @method \Roles insertAsPrevSiblingOf($node)
 * @method \Roles insertAsNextSiblingOf($node)
 * @method \Roles moveToFirstChildOf($node)
 * @method \Roles moveToLastChildOf($node)
 * @method \Roles moveToPrevSiblingOf($node)
 * @method \Roles moveToNextSiblingOf($node)
 * @method int deleteDescendants()
 * @method void shiftRLValues($delta, $first, $last = null, $scope = null)
 * @method void shiftLevel($delta, $first, $last = null, $scope = null)
 * @method void setNegativeScope($scope)
 * @method \Roles findRoot($scope = null)
 * @method \Roles[] findRoots()
 * @method boolean isNodeValid()
 * @method void makeRoomForLeaf(int $level, $scope = null)
 */
class Roles extends \RolesBase {
    const STATUS_ACTIVE = 'ACTIVE',
        STATUS_INACTIVE = 'INACTIVE';

    public function init() {
        parent::init();
        $this->attachBehavior('NestedSet', new NestedSet(), array(
            'left_attr' => 'lft',
            'right_attr' => 'rgt',
            'level_attr' => 'lvl',
            'scope_attr' => 'scope_id',
        ));
    }

    public function validationRules() {
        self::$_validate['name'][] = array(
            'name' => 'Require',
            'message' => 'name can not be blank!',
        );
    }

    /**
     * @param null $scope
     * @return \Roles
     */
    public static function retrieveRoot($scope = null) {
        $root = new self();
        $root = $root->findRoot($scope);
        if (!$root) {
            $root = new self();
            $root->scope = $scope;
            $root->taxonomy = $scope;
            $root->name = 'Root of ' .$scope;
            $root->makeRoot();
            $root->save();
        }

        return $root;
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

        /** @var \Roles[] $descendants */
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

    /**
     * Check role active or not
     * @return bool
     */
    public function isActive(){
        return $this->getStatus() == self::STATUS_ACTIVE;
    }

    /**
     * Get role's members
     * @return \Users[]
     */
    public function getMembers(){
        return self::getRolesMembers($this->getId());
    }

    /**
     * get roles's members by ids
     * @param $roles_id
     * @return \Users[]
     */
    public static function getRolesMembers($roles_id){
        $roles_id = (array) $roles_id;
        $result = [];
        if (!empty($roles_id)) {
            $result = \Users::select()
                ->where('`id` IN (SELECT user_id FROM `user_role` WHERE `role_id` IN (' .implode(',', $roles_id) .'))')
                ->execute();
        }

        return $result;
    }
}