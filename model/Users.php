<?php 
/**
 * Users
 * @version		$Id$
 * @package		Model

 */

require_once dirname(__FILE__) .'/Base/UsersBase.php';
class Users extends \UsersBase {
    const STATUS_ACTIVE = 'ACTIVE',
        STATUS_INACTIVE = 'INACTIVE',
        STATUS_DELETED = 'DELETED';

    const SECTION_STAFF = 'STAFF',
        SECTION_MEMBER = 'MEMBER',
        SECTION_GUESS = 'GUESS';

    /**
     * init
     */
    public function init() {
        parent::init();
        $this->attachBehavior(
            'TimeStamp', new \Flywheel\Model\Behavior\TimeStamp(), array(
                'create_attr' => 'register_time',
                'modify_attr' => 'modified_time'
            )
        );
    }

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

    /**
     * Check isStaff level
     * @return bool
     */
    public function isStaff() {
        return $this->getSection() == self::SECTION_STAFF;
    }

    /**
     * Check account is active or not
     * @return bool
     */
    public function isActive() {
        return $this->getStatus() == self::STATUS_ACTIVE;
    }

    /**
     * Check account was deleted
     * @return bool
     */
    public function isDeleted() {
        return $this->getStatus() == self::STATUS_DELETED;
    }

    /**
     * check user have verified his mobile number
     * @return bool
     */
    public function isVerifyEmail() {
        return (bool) $this->getActiveEmail();
    }

    /**
     * god reborn, plz help us
     * @return bool
     */
    public function isGod() {
        return 1 == $this->getId();
    }

    public function getShortName() {
        $full_name = '';

        $part = explode(' ', $this->getName());

        if( sizeof($part) >= 3 && $this->getName() != "" ){
            for($i = 0, $size = sizeof($part); $i < $size; ++$i) {
                if ($i != $size-1) {
                    if(isset($part[$i][0])){
                        $full_name .= mb_strtoupper(mb_substr($part[$i],0, 1, "UTF-8"), "UTF-8");
                    }
                } elseif(isset($part[$i])) {
                    $full_name .= '. ' .$part[$i];
                }
            }
        }
        $shorten_full_name = $this->getName();

        if( sizeof($part) >= 3 ) {
            $shorten_full_name = $full_name != "" ? $full_name : $this->getName();
        }

        $shorten_full_name = $shorten_full_name ? $shorten_full_name : $this->getUsername();

        return $shorten_full_name;
    }

    protected function _beforeSave() {
        parent::_beforeSave();
        if (!$this->secret) {
            $this->setSecret(self::genSecretKey());
        }
    }

    /**
     * hasting user's password
     * @param $plainText
     * @param null $salt
     * @return string
     */
    public static function hashPassword($plainText, $salt = null) {
        $salt = (null == $salt) ? \ModelUtil::randSha1(40) : substr($salt, 0, 40);
        return $salt . md5($salt . $plainText);
    }

    /**
     * Gen private secret key
     * @return string
     */
    public static function genSecretKey() {
        return \ModelUtil::randMd5(32);
    }

    public static function checkAvailableUsername($username)
    {
        $c = self::read()
            ->count('id')
            ->where('`username` = ?')
            ->setParameter(0, $username, \PDO::PARAM_STR)
            ->execute();

        return ($c == 0);
    }

    public static function checkAvailableEmail($email)
    {
        $c = self::read()
            ->count('id')
            ->where('`email` = ?')
            ->setParameter(0, $email, \PDO::PARAM_STR)
            ->execute();

        return ($c == 0);
    }
}