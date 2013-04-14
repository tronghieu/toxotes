<?php
use Flywheel\Config\ConfigHandler;
class HomeController extends AdminBaseController 
{
	public function executeDefault()
	{
		$this->setView('default');
		// return $this->setComponent();
	}
}