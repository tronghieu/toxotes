<?php 
/**
 * Roles
 *  This class has been auto-generated at 15/04/2013 10:50:21
 * @version		$Id$
 * @package		Model

 */

use Flywheel\Model\Behavior\NestedSet;

require_once dirname(__FILE__) .'/Base/RolesBase.php';
class Roles extends \RolesBase {
    public function init() {
        parent::init();
        $this->attachBehavior('NestedSet', new NestedSet(), array(
            'level_attr' => 'lvl',
            'left_attr' => 'lft',
            'right_attr' => 'rgt'
        ));

        $this->attachBehavior('Timestamp', new Timestamp(), array(
            'created_time' => 'created_at',
            'modified_time' => 'modified_at'
        ));
    }
}