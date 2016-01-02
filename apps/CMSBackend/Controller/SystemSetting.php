<?php
/**
 * Created by PhpStorm.
 * User: nobita
 * Date: 12/26/14
 * Time: 7:06 AM
 */

namespace CMSBackend\Controller;


use CMSBackend\Event\CMSBackendEvent;
use Flywheel\Base;
use Flywheel\Config\ConfigHandler;
use Flywheel\Html\Form\Checkbox;
use Flywheel\Html\Form\Input;
use Flywheel\Html\Form\RadioButton;
use Flywheel\Html\Form\SelectOption;
use Flywheel\Html\Form\TextArea;
use Flywheel\Session\Session;
use Toxotes\Plugin;

class SystemSetting extends CMSBackendBase {
    public $form_cfg = [];

    public function beforeExecute()
    {
        parent::beforeExecute(); // TODO: Change the autogenerated stub

        $this->form_cfg = [
            'common' => [
                'label' => t('Common Settings'),
                'settings' => [
                    'site_name' => [
                        'label' => t('Site Name'),
                        'control' => 'input',
                        'type' => 'text',
                    ],

                    'site_url' => [
                        'label' => t('Site Url'),
                        'control' => 'input',
                        'type' => 'text',
                        'placeholder' => 'http://'
                    ],

                    'email_address' => [
                        'label' => t('E-mail Address'),
                        'control' => 'input',
                        'type' => 'email'
                    ],

                    'contact_phone' => [
                        'label' => t('Company Phone'),
                        'control' => 'input',
                        'type' => 'tel'
                    ],

                    'contact_address' => [
                        'label' => t('Company Address'),
                        'control' => 'input',
                        'type' => 'text'
                    ],

                    'site_offline' => [
                        'label' => t('Site Offline?'),
                        'control' => 'checkbox',
                        'value' => 1
                    ],
                ]
            ]
        ];

        $other_setting = ConfigHandler::get('site_setting');

        if (!empty($other_setting)) {
            $this->form_cfg['common']['settings'] = Base::mergeArray($this->form_cfg['common']['settings'], $other_setting);
        }

        $this->form_cfg = Plugin::applyFilters('custom_system_setting', $this->form_cfg);
    }


    public function executeDefault()
    {
        $this->setView('Setting/form');
        $oms = \Setting::findAll('setting_key');
        $this->form_cfg = $this->_getFormInput($this->form_cfg, $oms);

        $this->view()->assign('frm_action', $this->createUrl('system_setting/save'));
        $this->view()->assign('message', Session::getInstance()->getFlash('setting.message'));
        $this->view()->assign('form_cfg', $this->form_cfg);
        return $this->renderComponent();
    }

    public function executeSave() {
        $settings = $this->post('setting', 'ARRAY', []);
        $oms = \Setting::findAll('setting_key');

        foreach ($this->form_cfg as $gk => $group) {
            foreach($group['settings'] as $key => $options) {
                if (isset($settings[$key])) {//form was set
                    if (isset($oms[$key])) {
                        $om = $oms[$key];
                    } else {
                        $om = new \Setting();
                        $om->setSettingKey($key);
                    }
                    $om->setSettingValue($settings[$key]);
                    $om->save();
                } else {
                    if ($options['control'] == 'checkbox') {
                        if (isset($oms[$key])) {
                            $om = $oms[$key];
                        } else {
                            $om = new \Setting();
                            $om->setSettingKey($key);
                        }
                        $om->setSettingValue('');
                        $om->save();
                    }
                }

                $this->dispatch('onAfterChangeSetting', new CMSBackendEvent($this, [
                    'setting' => $om
                ]));
            }
        }

        Session::getInstance()->setFlash('setting.message', t('Site\'s settings was saved!'));
        $this->redirect($this->createUrl('system_setting'));
    }

    /**
     * @param array $config
     * @param \Setting[] $setOms
     * @return mixed
     */
    private static function _getFormInput($config, $setOms){
        foreach ($config as &$group) {
            foreach ($group['settings'] as $key => $setting) {
                if (isset($setOms[$key]) && $setting['control'] != 'checkbox') {
                    $group['settings'][$key]['value'] = $setOms[$key]->getSettingValue();
                }

                if (!isset($group['settings'][$key]['value'])) {
                    $group['settings'][$key]['value'] = null;
                }
                //get form control object
                $name = "setting[{$key}]";
                $html_options = $setting;
                unset($html_options['label']);
                unset($html_options['value']);
                unset($html_options['control']);

                switch($setting['control']) {
                    case 'input':
                        $object = new Input($name, $group['settings'][$key]['value'], $html_options);
                        $object->setType($setting['type']);
                        unset($html_options['type']);
                        $group['settings'][$key]['controlObject'] = $object;
                        break;
                    case 'textarea':
                        $group['settings'][$key]['controlObject'] = new TextArea($name, $group['settings'][$key]['value'], $html_options);
                        break;
                    case 'selectOption' :
                        $object = new SelectOption($name, $group['settings'][$key]['value'], $html_options);
                        foreach(@$setting['options'] as $opt) {
                            $object->addOption($opt['label'], $opt['value'], @$opt['htmlOption']);
                        }
                        $group['settings'][$key]['controlObject'] = $object;
                        break;
                    case 'checkbox' :
                        $checkedValue = (isset($setOms[$key]))? $setOms[$key]->getSettingValue() : '';
                        $object = new Checkbox($name, $group['settings'][$key]['value'], $html_options);
                        $object->setExpectValue($checkedValue);
                        $group['settings'][$key]['controlObject'] = $object;
                        break;
                    case 'radio':
                        unset($html_options['options']);
                        $object = new RadioButton($name, $group['settings'][$key]['value']);
                        foreach(@$setting['options'] as $opt) {
                            $object->add($opt['value'], $opt['label'], @$opt['htmlOption'], @$opt['inputOption']);
                        }
                        $group['settings'][$key]['controlObject'] = $object;
                        break;
                }
            }
        }

        return $config;
    }
}