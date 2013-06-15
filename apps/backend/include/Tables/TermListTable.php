<?php
use Flywheel\Util\Inflection;
use Toxotes\Plugin;

/**
 * Created by JetBrains PhpStorm.
 * User: nobita
 * Date: 6/5/13
 * Time: 10:39 AM
 * To change this template use File | Settings | File Templates.
 */

class TermListTable extends ListTable {
    public function __construct($taxonomy) {
        parent::__construct($taxonomy);
        $this->tableHtmlOptions['class'] = 'table '.@$this->tableHtmlOptions['class'];
        $this->init();
    }

    public function prepareItems() {}

    public function init() {
        parent::init();
        $this->columns = array(
            'cb',
            'name' => array(
                'label' => t('Name'),
            ),
            'description' => array(
                'label' => t('Description')
            )
        );

        $this->columns = Plugin::applyFilters(
            'init_' .$this->taxonomy.'_term_columns',
            $this->columns
        );

        $this->columns[] = 'tool';
    }

    public function display() {
        echo '<table' .\Flywheel\Html\Html::serializeHtmlOption($this->tableHtmlOptions) .'>';
            echo '<thead>';
                echo $this->displayHeaderRow();
            echo '</thead>';
            echo '<tbody>';
                echo $this->displayRows();
            echo '</tbody>';
            echo '<tfoot>';
                echo $this->displayFootRow();
            echo '</tfoot>';
        echo '</table>';
    }

    public function displayHeaderRow() {
        $s = '';
        foreach($this->columns as $name => $column) {
            if (is_int($name)) {
                $name = $column;
            }

            if (is_scalar($column)) {
                $column = array('label' => $column);
            }

            if (!isset($column['htmlOption'])) {
                $column['htmlOption'] = array();
            }

            $s .= '<th' .\Flywheel\Html\Html::serializeHtmlOption($column['htmlOption']) .'>';

            if ('cb' == $name) {
                $s .= '<label><input class="check-all" type="checkbox"> &darr;</label>';
            } else if ('tool' == $name) {
                $s .= '&nbsp;';
            } else {
                $s .= $column['label'];
            }

            $s.=  '</th>';
        }

        return $s;
    }

    public function displayRows() {
        $s = '';

        foreach($this->items as $item) {
            $s .= $this->_rows($item);
        }

        return $s;
    }

    protected function _rows($item) {
        $s = '';
        $s .='<tr>';

        foreach ($this->columns as $name => $column) {
            if (is_int($name)) {
                $name = $column;
            }

            $class = "class=\"term-item column-{$name}\"";

            $s .= "<td $class id=\"term-{$item->getId()}\">";

            if ('cb' == $name) {
                $s .= '<label>
                            <input type="checkbox" name="bulk_actions[]" value="' .$item->id .'" class="check-list">
                        </label>';
            } else if ('tool' == $name) {
                $removeLink = \Flywheel\Factory::getRouter()->createUrl('category/delete', array('id' => $item->id));
                $editLink = \Flywheel\Factory::getRouter()->createUrl('category/edit', array('id' => $item->id));
                $s .= '<a href="' .$editLink .'">' .t('Edit') .'</a> | <a href="' .$removeLink .'" class="tool-link tool-remove" rel="term-' .$item->getId() .'">' .t('Remove') .'</a>';
            } else {
                $method = '_column' . Inflection::camelize($name);
                if (method_exists($this, $method)) {
                    $s .= $this->$method($item);
                } else {
                    $s .= $this->_columnCustom($name, $item);

                }
            }

            $s .= '</td>';
        }

        $s .='</tr>';

        return $s;
    }

    protected function _columnName($item) {
        $name = $item->getName();
        $s = '<strong><span style="font-family: sans-serif;">' .(($item->getLevel() > 1)? str_repeat('&#8212;', $item->getLevel()-1): '').'</span> '
            .$name .'</strong>';
        return $s;
    }

    protected function _columnDescription($item) {
        $desc = $item->getDescription();
        if (mb_strlen($desc) > 140) {
            $desc = mb_substr($desc, 0, 120) .'...';
        }

        return $desc;
    }

    protected function _columnCustom($name, $item) {
        return Plugin::applyFilters('manage_' .$this->taxonomy .'_custom_column', '', $name, $item->id);
    }

    public function displayFootRow() {
        $s = '';
        foreach($this->columns as $name => $column) {
            if (is_int($name)) {
                $name = $column;
            }

            if (is_scalar($column)) {
                $column = array('label' => $column);
            }

            if (!isset($column['htmlOption'])) {
                $column['htmlOption'] = array();
            }

            $s .= '<th' .\Flywheel\Html\Html::serializeHtmlOption($column['htmlOption']) .'>';

            if ('cb' == $name) {
                $s .= '<label><input class="check-all" type="checkbox"> &uarr;</label>';
            }else if ('tool' == $name) {
                $s .= '&nbsp;';
            } else {
                $s .= $column['label'];
            }

            $s.=  '</th>';
        }

        return $s;
    }
}