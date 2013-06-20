<?php 
/**
 * ItemAttachments
 *  This class has been auto-generated at 15/04/2013 10:50:21
 * @version		$Id$
 * @package		Model

 */

use Flywheel\Db\Type\DateTime;

require_once dirname(__FILE__) .'/Base/ItemAttachmentsBase.php';
class ItemAttachments extends \ItemAttachmentsBase {
    protected function _beforeSave() {
        if ($this->isNew()) {
            $this->setUploadedTime(new DateTime());
        }

        parent::_beforeSave();
    }
}