<?php
use Flywheel\Factory;
use Flywheel\Router\WebRouter;
use Flywheel\Util\Inflection;
use Toxotes\Plugin;

class PostListTable extends ListTable {
    public function __construct($taxonomy) {
        parent::__construct($taxonomy);
        $this->tableHtmlOptions['class'] = 'table '.@$this->tableHtmlOptions['class'];
        $this->init();
    }

    public function init() {
        parent::init();
        $this->columns = array(
            'cb',
            'title' => array(
                'label' => t('Title'),
            ),
            'highlight' => array(
                'label' => '<span class="highlight-column-title"><i class="icon-star"></i></span>',
            ),
            'status' => array(
                'label' => t('Status'),
                'value' => '$item->getStatus();'
            ),
            'category' => array(
                'label' => t('Category'),
            ),
            'ordering' => array(
                'label' => t('Ordering'),
                'value' => '$item->getOrdering();'
            ),
            'language' => array(
                'label' => t('Language'),
                'value' => '$item->getLanguage();'
            ),
            'date' => array(
                'label' => t('Date')
            ),
            'id' => array(
                'label' => 'Id',
                'value' => '$item->getId();'
            ),
        );

        if ('post' != $this->taxonomy) {
            unset($this->columns['highlight']);
        }

        $this->columns = Plugin::applyFilters(
            'init_' .$this->taxonomy.'_post_columns',
            $this->columns
        );
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
        $s .='<tr class="post-row" id="post-' .$item->getId() .'">';

        foreach ($this->columns as $name => $column) {
            if (is_int($name)) {
                $name = $column;
            }

            $class = "class=\"post-item column-{$name}\"";

            $s .= "<td $class>";

            if ('cb' == $name) {
                $s .= '<label>
                            <input type="checkbox" name="bulk_actions[]" value="' .$item->id .'" class="check-list">
                        </label>';
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

    protected function _columnTitle($item) {
        /** @var Posts $item */
        $title = $item->getTitle();
        if (!$title) {
            $title = t('(no title)');
        }

        $s = '<div class="row-title"><strong>'.$title .'</strong>';
        if ($item->getIsDraft()) {
            $s .= ' - <em style="font-family:Georgia; font-size: 14px; color: #666">' .t('Draft') .'</em>';
        }
        $s .= '</div>';
        $subtool = '';
        $subtool = '<div class="sub-tool">';
        $subtool = Plugin::applyFilters('custom_' .$item->taxonomy.'_subtool', $subtool);
        $s .= $subtool;

        $removeLink = Factory::getRouter()->createUrl('post/remove', array('id' => $item->id));
        $editLink = Factory::getRouter()->createUrl('post/edit', array('id' => $item->id));
        $s .= '<a href="' .$editLink .'" class="tool-link tool-edit">' .t('Edit') .'</a> | <a href="' .$removeLink .'" class="tool-link tool-remove" rel="post-' .$item->getId() .'">' .t('Remove') .'</a>';
        $s .= '</div>';

        return $s;
    }

    protected function _columnHighlight($item) {
        /** @var Posts $item $s */
        /** @var WebRouter $router */

        $router = Factory::getRouter();

        if ($item->getIsDraft()) {
            return '<span class="highlight-column">--</span>';
        }

        $s = '';
        if ($item->getIsPin()) {
            $s .= '<a href="' .$router->createUrl('post/unpin', array('id' => $item->getId())) . '" class="tool-unpin"><i class="icon-star"></i> </a>';
        } else {
            $s .= '<a href="' .$router->createUrl('post/pin', array('id' => $item->getId())) . '" class="tool-pin"><i class="icon-star-empty"></i> </a>';
        }

        return $s;
    }

    protected function _columnCategory($item) {
        /** @var Posts $item */

        $s = '';
        if ($item->getTermId()) {
            $category = Terms::retrieveById($item->getTermId());
            if ($category) {
                $eLink = Factory::getRouter()->createUrl('category/edit', array(
                    'id' => $category->getId(),
                    'taxonomy' => $category->getTaxonomy()
                ));
                $s .= '<a href="' .$eLink .'">' .$category->getName() .'</a>';
            }
        }

        return $s;
    }

    protected function _columnDate($item) {
        /** @var Posts $item */
        $date = new DateTime($item->getModifiedTime());
        $s = '<div>' .$date->format('d/m/Y') .'</div>';
        $s .= '<div style="font-family:Georgia">' .$date->format('H:s') .'</div>';
        return $s;
    }

    protected function _columnOrdering($item) {
        /** @var Posts $item */
        $s = '<input name="ordering[' .$item->getId() .']" type="text" value="' .$item->getOrdering() .'" class="input-mini">';
        return $s;
    }

    protected function _columnCustom($name, $item) {
        $value = null;
        if (isset($this->columns[$name]['value'])) {
            eval('$value = ' .$this->columns[$name]['value']);
        }

        if (isset($this->columns[$name]['callback'])) {
            $value = call_user_func_array($this->columns[$name]['callback'], array($name, $item, $value));
        }

        $value =  Plugin::applyFilters('manage_' .$this->taxonomy .'_custom_column', $value, $name, $item->id);

        return $value;
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
            } else {
                $s .= $column['label'];
            }

            $s.=  '</th>';
        }

        return $s;
    }

    public function render() {
        $html = '';
        $html .= '<table' .\Flywheel\Html\Html::serializeHtmlOption($this->tableHtmlOptions) .'>';
            $html .= '<thead>';
                $html .= $this->displayHeaderRow();
            $html .= '</thead>';
            $html .= '<tbody>';
                $html .= $this->displayRows();
            $html .= '</tbody>';
            $html .= '<tfoot>';
                $html .= $this->displayFootRow();
            $html .= '</tfoot>';
        $html .= '</table>';
        return $html;
    }

    public function display() {
        echo $this->render();
    }
}