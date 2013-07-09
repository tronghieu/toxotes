<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nobita
 * Date: 6/27/13
 * Time: 3:36 PM
 * To change this template use File | Settings | File Templates.
 */

class HomeController extends FrontendBaseController {
    public function executeDefault() {
        return $this->renderComponent();
    }
}