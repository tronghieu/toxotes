<?php
use Flywheel\Config\ConfigHandler;
class ConfigController extends AdminBaseController 
{
	public function executeDefault()
	{
		$this->setView('default');
		// return $this->setComponent();
	}
}