<?php
use Flywheel\Config\ConfigHandler;
use Flywheel\Db\Expression;
use Flywheel\Validator\Util as ValidatorUtil;
class UserController extends AdminBaseController
{

    public function executeDefault($limit=20,$offset=0)
    {
        $limit=20;
        $user=null;

        if(isset($_GET)){
            $id=$this->request()->get('id');
            $email=$this->request()->get('email');
            $full_name=$this->request()->get('full_name');
            $phone=$this->request()->get('phone');

            $conn=Users::read();
            if(!empty($id)) $conn->andWhere('`id`='.$id.'');
            if(!empty($email)) $conn->andWhere('`email`='.$email.'');
            if(!empty($password)) $conn->andWhere('`password`='.$password.'');
            if(!empty($full_name)) $conn->andWhere('`full_name`='.$full_name.'');
            if(!empty($phone)) $conn->andWhere('`phone`="'.$phone.'"');
            if(!empty($status)) $conn->andWhere('`status`='.$status.'');
            if(!empty($banned)) $conn->andWhere('`banned`='.$banned.'');
            if(!empty($last_login_time)) $conn->andWhere('`last_login_time`='.$last_login_time.'');
            if(!empty($lats_login_ip)) $conn->andWhere('`last_login_ip`='.$lats_login_ip.'');

            $conn->setMaxResults($limit)->orderBy('id');

            $users = $conn->execute()->fetchAll(\PDO::FETCH_ASSOC);
        }
        $this->view()->assign('users',$users);
        $this->setView('default');
        // return $this->setComponent();
    }

    protected function _save(\Users &$user, &$error) {
        if ($this->request()->isPostRequest()) {
            //validate here, assign error in to $error
            $email = $this->request()->post('email');
            $pass = $this->request()->post('password');
            $con_pass = $this->request()->post('con_password');
            $full_name = $this->request()->post('full_name');
            $status = $this->request()->post('status');
            $phone = $this->request()->post('phone');
            $banned = $this->request()->post('banned');
            if($pass != $con_pass){
                $error[] = array('message' => 'Confirm password fail!');
            }
            if(null ==($email)){
                $error[] = array('message' => 'Email can not empty!');
            } elseif(!ValidatorUtil::isValidEmail($email)){
                $error[] = array('message' => 'Email format not valid!');
            }
            if(null ==($pass)){
                $error[] = array('message' => 'Password can not empty!');
            } elseif(!ValidatorUtil::isValidPassword($pass)){
                $error[] = array('message' => 'Password format not valid!');
            }
            if(Users::findOneByEmail($email)!=null){
                $error[] = array('message' => 'Email existed !');
            }
            $user->email = $email;
            $user->password = \Users::hashPassword($pass);
            $user->full_name = $full_name;
            $user->status = $status;
            $user->phone = $phone;
            $user->banned = $banned;
            if (empty($error)) {
                if ($user->save()) {
                    //dispatch a event
                    $this->dispatch('onAfterSaveUser' , new AdminEvent($this, array(
                        'user' => $user
                    )));

                    $this->redirect('user/'); //redirect if success
                } else if (!$user->isValid()) {
                    $error = $user->getValidationFailures();
                }
            }
            //error nothing
        }
    }

    public function executeCreate() {
        $this->setView('create');
        $error = array();
        $user = new \Users();
        $this->_save($user,$error);
        $this->view()->assign('error', $error);
        $this->view()->assign('user', $user);
    }

    public function executeEdit() {
        $this->setView('edit');
        $id = $this->request()->get('id', 'ALNUM');
        $error = array();
        if ($user = \Users::findOneById($id)) {
        if($this->request()->isPostRequest()){
			$full_name=$this->request()->post('full_name');
			$phone=$this->request()->post('phone');
			$status=$this->request()->post('status');
			$banned=$this->request()->post('banned');

            $user->full_name=$full_name;
            $user->phone=$phone;
            $user->status=$status;
            $user->banned=$banned;
                if ($user->save()) {
                    //dispatch a event
                    $this->dispatch('onAfterSaveUser' , new AdminEvent($this, array(
                        'user' => $user
                    )));

                    $this->redirect('user/'); //redirect if success
                } else if (!$user->isValid()) {
                    $error = $user->getValidationFailures();
                }
    	    }
        }
        $this->view()->assign('error', $error);
        $this->view()->assign('user', $user);
    }
    public function executeChange(){
        $this->setView('change');
        $id = $this->request()->get('id', 'ALNUM');
        $error = array();
        if($user = Users::findOneById($id)){
            if($this->request()->isPostRequest()){
                $new_pass=$this->request()->post('new_pass');
                $con_pass = $this->request()->post('con_pass');
                if(null ==($new_pass)){
                    $error[] = array('message' => 'New password can not empty!');
                }
                if(null ==($con_pass)){
                    $error[] = array('message' => 'Confirm password can not empty!');
                }
                if($new_pass != $con_pass){
                    $error[] = array('message' => 'Confirm password fail!');
                }
                $user->password = Users::hashPassword($new_pass);
                if(empty($error)){
                    if ($user->save()) {
                        //dispatch a event
                        $this->dispatch('onAfterSaveUser' , new AdminEvent($this, array(
                            'user' => $user
                        )));

                        $this->redirect('user/'); //redirect if success
                    } else if (!$user->isValid()) {
                        $error = $user->getValidationFailures();
                    }
                }
            }
        }
        $this->view()->assign('error',$error);
        $this->view()->assign('user', $user);
    }
}