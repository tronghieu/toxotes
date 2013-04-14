<?php
namespace Flywheel\Model\Behavior;
class UnixTimeStampBehavior extends ModelBehavior {
    public function init() {
        parent::init();
        /* @var \Flywheel\Model\ActiveRecord $owner */
        $owner = $this->getOwner();
        $owner->getEventDispatcher()->addListener('onBeforeSave', array($this, 'onBeforeSave'));
    }

    public function onBeforeSave($event) {}
}
