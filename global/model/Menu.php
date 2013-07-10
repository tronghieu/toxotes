<?php 
/**
 * Menu
 *  This class has been auto-generated at 10/07/2013 16:06:44
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
 * @method Menu makeRoot()
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
 * @method null|Menu getParent()
 * @method bool|Menu getPrevSibling(\Flywheel\Db\Query $query = null)
 * @method bool|Menu getNextSibling(\Flywheel\Db\Query $query = null)
 * @method array getChildren(\Flywheel\Db\Query $query = null)
 * @method null|Menu getFirstChild(\Flywheel\Db\Query $query = null)
 * @method null|Menu getLastChild(\Flywheel\Db\Query $query = null)
 * @method Menu[] getSiblings($query = null)
 * @method Menu[] getDescendants($query = null)
 * @method Menu[] getBranch($query = null)
 * @method Menu[] getAncestors($query = null)
 * @method Menu addChild($node)
 * @method Menu insertAsFirstChildOf($node)
 * @method Menu insertAsLastChildOf($node)
 * @method Menu insertAsPrevSiblingOf($node)
 * @method Menu insertAsNextSiblingOf($node)
 * @method Menu moveToFirstChildOf($node)
 * @method Menu moveToLastChildOf($node)
 * @method Menu moveToPrevSiblingOf($node)
 * @method Menu moveToNextSiblingOf($node)
 * @method int deleteDescendants()
 * @method void shiftRLValues($delta, $first, $last = null, $scope = null)
 * @method void shiftLevel($delta, $first, $last = null, $scope = null)
 * @method void setNegativeScope($scope)
 * @method Menu findRoot($scope = null)
 * @method Menu[] findRoots()
 * @method boolean isNodeValid()
 * @method void makeRoomForLeaf(int $level, $scope = null)
 */

require_once dirname(__FILE__) .'/Base/MenuBase.php';
class Menu extends \MenuBase {
}