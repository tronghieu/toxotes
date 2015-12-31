<?php
namespace CMSBackend\Controller;
use CMSBackend\Controller\CMSBackendBase;
class CMSBackend extends CMSBackendBase{

    public function executeDefault(){
        return $this->renderComponent();
    }
}
