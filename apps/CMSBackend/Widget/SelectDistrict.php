<?php

class SelectDistrict extends \CMSBackend\Widget\CMSBackendBaseWidget {
    protected function _init() {
        $doc = \Flywheel\Factory::getDocument();
        $doc->addJsVar('get_locations_url', $this->getRender()->createUrl('transporter/location/get_all_locations'));
        $doc->addJs('js/process/transporter/transporter.js');
        $doc->addJs('js/process/transporter/location.js');
    }

    public function end() {
        $htmlOptions = array_merge([
            'rel' => $this->rel,
            'data-value' => $this->selected,
            'id' => $this->id,
        ], $this->htmlOptions);
        $this->form->selectOption($this->name, '', $htmlOptions)->addOption($this->label, 0)->display();
    }
}