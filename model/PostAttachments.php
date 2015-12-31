<?php 
/**
 * PostAttachments
 * @version		$Id$
 * @package		Model

 */

require_once dirname(__FILE__) .'/Base/PostAttachmentsBase.php';
class PostAttachments extends \PostAttachmentsBase {
    /**
     * init
     */
    public function init() {
        parent::init();
        $this->attachBehavior(
            'TimeStamp', new \Flywheel\Model\Behavior\TimeStamp(), array(
                'create_attr' => 'uploaded_time',
            )
        );
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