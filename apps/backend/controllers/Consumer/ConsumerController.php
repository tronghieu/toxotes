<?php
use Flywheel\Config\ConfigHandler;
use Flywheel\Db\Expression;
class ConsumerController extends AdminBaseController
{

    public function executeDefault($limit=20,$offset=0)
    {
        $limit=20;
        $consumer=null;

        if(isset($_GET)){
            $id=$this->request()->get('id');
            $name=$this->request()->get('name');
            $allowed_ips=$this->request()->get('allowed_ips');
            $desc=$this->request()->get('desc');
            $status=$this->request()->get('status');
            $public_key=$this->request()->get('public_key');

            $conn=Consumer::read();
            if(!empty($id)) $conn->andWhere('`id`='.$id.'');
            if(!empty($name)) $conn->andWhere('`name`='.$name.'');
            if(!empty($allowed_ips)) $conn->andWhere('`allowed_ips`='.$allowed_ips.'');
            if(!empty($desc)) $conn->andWhere('`desc`='.$desc.'');
            if(!empty($status)) $conn->andWhere('`status`="'.$status.'"');
            if(!empty($public_key)) $conn->andWhere('`public_key`='.$public_key.'');

            $conn->setMaxResults($limit)->orderBy('id', 'DESC');

            $consumers = $conn->execute()->fetchAll(\PDO::FETCH_ASSOC);
        }
        $this->view()->assign('consumers',$consumers);
        $this->setView('default');
        // return $this->setComponent();
    }

    protected function _save(\Consumer &$consumer, &$error) {
        if ($this->request()->isPostRequest()) {
            //validate here, assign error in to $error
            $consumer->name = $this->request()->post('con_name');
            $consumer->desc = $this->request()->post('desc');
            $consumer->status = $this->request()->post('status');
            $consumer->allowed_ips = $this->request()->post('allowed_ips');
            $consumer->public_key = $this->request()->post('public_key');
            if(null ==($consumer->name)){
                $error[] = array('message' => 'Name can not empty!');
            }
            if(null ==($consumer->public_key)){
                $error[] = array('message' => 'Public key can not empty!');
            }

            //$consumer->hydrate($_POST['consumer']);

            if (empty($error)) {
                if ($consumer->save()) {
                    //dispatch a event
                    $this->dispatch('onAfterSaveConsumer' , new AdminEvent($this, array(
                        'consumer' => $consumer
                    )));

                    $this->redirect('consumer/'); //redirect if success
                } else if (!$consumer->isValid()) {
                    $error = $consumer->getValidationFailures();
                }
            }
            //error nothing
        }
    }

    public function executeCreate() {
        $this->setView('create');
        $error = array();
        $consumer = new \Consumer();
        $this->_save($consumer,$error);
        $this->view()->assign('error', $error);
        $this->view()->assign('consumer', $consumer);
    }

    public function executeEdit() {
        $this->setView('edit');
        $id = $this->request()->get('id', 'ALNUM');
        $error = array();
        if ($consumer = \Consumer::findOneById($id)) {
            $this->_save($consumer, $error);
        } else {
            $this->redirect($this->createUrl('consumer/'));
        }

        $this->view()->assign('error', $error);
        $this->view()->assign('consumer', $consumer);
    }
}