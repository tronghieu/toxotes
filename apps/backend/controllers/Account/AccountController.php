<?php
use Flywheel\Config\ConfigHandler;
class AccountController extends AdminBaseController 
{
	public function executeDefault($limit=20,$offset=0)
	{
        $limit=20;
        $account=null;

		if(isset($_GET)){
			$id=$this->request()->get('id');
			$uk=$this->request()->get('uk');
			$name=$this->request()->get('name');
			$version=$this->request()->get('version');
			$currency=$this->request()->get('currency');
			$balance=$this->request()->get('balance');
			$frozen_balance=$this->request()->get('frozen_balance');
			$status=$this->request()->get('status');
			$type=$this->request()->get('type');

			$conn=Account::read();
            if(!empty($id)) $conn->andWhere('`id`='.$id.'');
            
            if(!empty($uk)) $conn->andWhere('`uk`='.$uk.'');
            if(!empty($name)) $conn->andWhere('`name`='.$name.'');
            if(!empty($version)) $conn->andWhere('`version`='.$version.'');
            if(!empty($currency)) $conn->andWhere('`currency`="'.$currency.'"');
            if(!empty($balance)) $conn->andWhere('`balance`='.$balance.'');
            if(!empty($frozen_balance)) $conn->andWhere('`frozen_balance`='.$frozen_balance.'');
            if(!empty($status)) $conn->andWhere('`status`="'.$status.'"');
            if(!empty($type)) $conn->andWhere('`type`="'.$type.'"');
            
            $conn->setMaxResults($limit)->orderBy('id', 'DESC');
            
            $accounts = $conn->execute()->fetchAll(\PDO::FETCH_ASSOC);
		}
        $this->view()->assign('accounts',$accounts);
		$this->setView('default');
		// return $this->setComponent();
	}

    public function executeView()
    {
        $id = $this->request()->get('id', 'INT', 0);
        $account=Account::findOneById($id);

        $this->view()->assign('account',$account);
        $this->setView('view');
        return $this->renderComponent();
    }
    
    public function executeUpdate()
    {
		$id=$this->request()->get('id');
		$account=Account::findOneById($id);
		
		$submit=$this->request()->post('submit');
		
		if($this->request()->isPostRequest()){
			$status=$this->request()->post('status','string');
			if(!empty($status)){
				$account->status=$status;
				if($account->save()){
					$this->request()->redirect($this->createUrl('account/view',array('id'=>$id)));
				}
			}
		}

        $this->view()->assign('account',$account);
        $this->setView('update');
        return $this->renderComponent();
    }
    
    /**
    * function create new account
    * 
    */
    public function executeCreate()
    {
    	if($this->request()->isPostRequest()){
			$name=$this->request()->post('name','string');
			$currency=$this->request()->post('currency','string');
			$status=$this->request()->post('status','string');
			$type=$this->request()->post('type','string');
			
			$uk=Account::genUkAccount();
			
			$account= new Account();
			$account->name=$name;
			$account->uk=$uk;
			$account->currency=$currency;
			$account->status=$status;
			$account->type=$type;
			
			if($account->save()){
				$this->request()->redirect($this->createUrl('account/view',array('id'=>$account->id)));
			}
			else{
				throw new Exception('can not create account: ');
			}
    	}
    	
		$this->setView('create');
    }
    
}