<?php 
/**
 * ItemAttachments
 *  This class has been auto-generated at 15/04/2013 10:50:21
 * @version		$Id$
 * @package		Model

 */

use Flywheel\Db\Type\DateTime;
use Flywheel\Event\Event;

require_once dirname(__FILE__) . '/Base/PostAttachmentsBase.php';
class PostAttachments extends \PostAttachmentsBase {

    protected function _beforeSave() {
        if ($this->isNew()) {
            $this->setUploadedTime(new DateTime());
        }

        parent::_beforeSave();
    }

    /**
     *
     */
    public function hit() {
        $this->setHits($this->getHits() + 1);
        $this->save(false);
    }

    /**
     * return file size in bytes
     * @return int
     */
    public function getFileSize() {
        if (file_exists($file = PUBLIC_DIR .DIRECTORY_SEPARATOR .rtrim($this->getFile() ,'/'))) {
            return filesize($file);
        }

        return 0;
    }
}