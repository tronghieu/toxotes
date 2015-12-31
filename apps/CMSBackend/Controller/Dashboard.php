<?php
/**
 * Created by PhpStorm.
 * User: nobita
 * Date: 12/6/14
 * Time: 2:31 AM
 */

namespace CMSBackend\Controller;


class Dashboard extends CMSBackendBase {

    public function executeDefault()
    {
        $this->setView('Dashboard/default');
        $this->document()->title = t('Dashboard');
        // TODO: Implement executeDefault() method.
    }
}