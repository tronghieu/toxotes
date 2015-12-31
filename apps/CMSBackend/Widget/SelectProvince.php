<?php
use CMSBackend\Widget\CMSBackendBaseWidget;
use Flywheel\Html\Form;

class SelectProvince extends CMSBackendBaseWidget {
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
        /** @var Form $this->form */
        $this->form->selectOption($this->name, '', $htmlOptions)->display();
        $doc = \Flywheel\Factory::getDocument();
        $doc->addJsCode('Transporter.Location.Province.display("#' .$this->id .'");');
    }
}