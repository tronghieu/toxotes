<?php
class Funny404Shower {
	private static $_list = array();
	public static function getRandom404Page() {
		if (empty(self::$_list)) {
			require_once MING_UTIL .'FolderUtil.php';
			self::$_list = folder_list_files(dirname(__FILE__) .DS .'404templates' .DS);
		}

		$rand = array_rand(self::$_list);
		return self::$_list[$rand];
	}

	public static function show(Exception $e) {
		$request = Ming_Factory::getRequest();
		$temp = $request->get('s');
		if (null == $temp) {
			$temp = self::getRandom404Page();
		} else if (!file_exists(dirname(__FILE__) .'/404templates/' .$temp .'.phtml')) {
			$temp = self::getRandom404Page();
		} else {
			$temp .= '.phtml';
		}

		header("HTTP/1.0 404 Not Found");
		header("Status: 404 Not Found");
		$view = new Ming_View();
		$view->assign('home_page', MING_SITE);
		$view->assign('admin_email', 'mingvn.contact@gmail.com');
		$view->setFileExtension('');
		$view->display(dirname(__FILE__) .'/404templates/' .$temp);
		Ming_Application::end();
	}
}
