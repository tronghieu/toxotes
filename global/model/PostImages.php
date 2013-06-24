<?php 
/**
 * ItemImages
 *  This class has been auto-generated at 15/04/2013 10:50:21
 * @version		$Id$
 * @package		Model

 */

use Flywheel\Db\Type\DateTime;

require_once dirname(__FILE__) . '/Base/PostImagesBase.php';
class PostImages extends \PostImagesBase {
    protected function _beforeSave() {
        if ($this->isNew()) {
            $this->setCreatedTime(new DateTime());
            $this->setModifiedTime(new DateTime());
        } else if ($this->hasColumnsModified()) {
            $this->setModifiedTime(new DateTime());
        }
        parent::_beforeSave();
    }
}