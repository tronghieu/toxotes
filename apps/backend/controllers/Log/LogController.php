<?php
use Flywheel\Config\ConfigHandler;
class LogController extends AdminBaseController 
{
	public function executeDefault()
	{
		$this->setView('default');
		// return $this->setComponent();
	}
}