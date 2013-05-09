<?php 
/**
 * Users
 *  This class has been auto-generated at 15/04/2013 10:50:21
 * @version		$Id$
 * @package		Model

 */

require_once dirname(__FILE__) .'/Base/UsersBase.php';
class Users extends \UsersBase {

    const STATUS_ACTIVE = 1,
        STATUS_INACTIVE = 0,
        STATUS_DELETED = -1;

    public function validationRules() {
        self::$_validate['username'][] = array(
            'name' => 'Match',
            'value' => '/^[a-z0-9_-]{3,16}$/',
            'message' => "username's format is not valid!");

        self::$_validate['username'][] = array(
            'name' => 'Require',
            'message' => "username can not be blank!");

        self::$_validate['email'][] = array(
            'name' => 'Email',
            'message' => "email's format is not valid!");

        self::$_validate['name'][] = array(
            'name' => 'Require',
            'message' => 'name can not be blank!',
        );

        self::$_validate['phone_number'][] = array(
            'name' => 'Match',
            'value' => '/^((\+|00)+[0-4]+[0-9]+)?([ -]?[0-9]{2,15}){1,5}$/',
            'message' => "phone number's format is not valid!"
        );
    }

    protected function _beforeSave() {
        if ($this->isNew()) {
            $this->setCreatedTime(time());
            $this->setRegisterTime(new \Flywheel\Db\Type\DateTime());
            $this->setSecret(ModelPeer::randMd5(32));
        }

        $this->setModifiedTime(time());
    }

    public static function hashPassword($plainText, $salt = null) {
        if (null == $salt) {
            $salt = ModelPeer::randMd5(32);
        } else {
            $salt = substr($salt, 0, 32);
        }

        return $salt . md5($salt . $plainText);
    }
}