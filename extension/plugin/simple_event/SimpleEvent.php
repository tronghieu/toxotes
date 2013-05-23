<?php
use Flywheel\Event\Event;

/**
 * Created by JetBrains PhpStorm.
 * User: nobita
 * Date: 5/22/13
 * Time: 10:20 AM
 * To change this template use File | Settings | File Templates.
 */

class SimpleEvent {
    public function addMenu(Event $event) {
        /** @var BackendSidebar $owner */
        $owner = $event->sender;
        $owner->items[] = array(
            'label' => t('Training/Events'),
            'url' => array('post/default', 'type' => 'event'),
            'items' => array(
                array('label' => t('Add Event'),
                    'url' => array('post/create', 'type' => 'event')
                ),
                array('label' => t('Event Categories'),
                    'url' => array('category/default', 'type' => 'event')
                ),
            ),
        );
    }
}