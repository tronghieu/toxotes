<?php
class SelectWidgetBlock extends AdminBaseWidget {
    public $list = array();
    public $viewFile = 'select_widget_block';

    public function begin() {
        $finder = new \Flywheel\Finder\Finder();
        $dirs = $finder->in(EXTENSION_DIR .'/widget/')
            ->directories()
            ->depth('==0');

        foreach ($dirs as $d) {
            /** @var \Symfony\Component\Finder\SplFileInfo $d */
            $this->list[] = str_replace('/','.','extension/widget/'.$d->getRelativePathname());
        }
    }

    public function end() {
        if (!$this->form) {
            $this->form = new Flywheel\Html\Form();
        }

        $select = $this->form->selectOption($this->elementName, $this->selected, (array) $this->htmlOptions)
                    ->addOption(t('Select widget block'), '');

        for($i = 0, $size = sizeof($this->list); $i < $size; ++$i) {
            $select->addOption($this->list[$i],$this->list[$i]);
        }

        return $this->render(array(
            'selected' => $this->selected,
            'label' => $this->label,
            'error' => $this->error,
            'list' => $this->list,
            'select' => $select
        ));
    }
}