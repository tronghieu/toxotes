<?php 
/**
 * Users
 *  This class has been auto-generated at 29/03/2013 19:16:37
 * @version		$Id$
 * @package		Model

 */

require_once dirname(__FILE__) .'/Base/UsersBase.php';
class Users extends \UsersBase {

    public static function hashPassword($plainText, $salt = null) {
        if (null == $salt) {
            $salt = ModelPeer::randCrc32b(16);
        } else {
            $salt = substr($salt, 0, 16);
        }

        return $salt . sha1($salt . $plainText);
    }

    protected function _beforeSave() {
        parent::_beforeSave();
        if ($this->isNew() && null == $this->secret) {
            $this->secret = ModelPeer::randMd5(32, $this->email);

            $this->created_time = $this->modified_time = date ("Y-m-d H:m:s");
        } else {
            $this->modified_time = date ("Y-m-d H:m:s");
        }
    }

    public function reload() {
        parent::reload();
        self::addInstanceToPool($this, $this->id);
    }

    public static function retrieveById($id) {
        if (!$id)
            return false;

        if (null != ($obj = self::getInstanceFromPool($id))) {
            return $obj;
        }

        $obj = self::findOneById($id);
        if ($obj) {
            self::addInstanceToPool($obj, $obj->id);
        }

        return $obj;
    }
}