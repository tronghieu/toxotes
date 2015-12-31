<?php
/**
 * Created by PhpStorm.
 * User: nobita
 * Date: 1/6/15
 * Time: 4:41 AM
 */

namespace CMSBackend\Controller\Transporter;


use Flywheel\Factory;

class Location extends Base {

    public function executeDefault()
    {
        // TODO: Implement executeDefault() method.
    }

    public function executeGetAllLocations()
    {
        $tree = \Location::tree();
        $result = [];
        foreach($tree as $t) {
            $result[] = $t->toArray();
        }

        Factory::getResponse()->setContentType('application/json');
        return $this->renderText(json_encode($result));
    }
}