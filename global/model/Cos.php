<?php 
/**
 * Cos
 *  This class has been auto-generated at 04/02/2013 17:00:43
 * @version		$Id$
 * @package		Model

 */

require_once dirname(__FILE__) .'/Base/CosBase.php';
class Cos extends \CosBase {
    protected function _beforeSave() {
        if (null == $this->track_time) {
            $this->track_time = new \Flywheel\Db\Expression('NOW()');
        }
    }
}