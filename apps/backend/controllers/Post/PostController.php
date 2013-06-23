<?php

use Toxotes\Plugin;

class PostController extends AdminBaseController {
    public function executeDefault() {
        $type = $this->request()->get('type', 'STRING', 'post');
        $this->dispatch('onBeginListingItem', new AdminEvent($this));

        $this->dispatch('onAfterListingItem', new AdminEvent($this));

        return $this->renderComponent();
    }

    public function executeCreate() {
        $taxonomy = $this->request()->get('taxonomy', 'STRING', 'post');
        $item = new Items();
        $this->setView('form');

        $this->view()->assign(array(
            'item' => $item,
            'taxonomy' => $taxonomy,
        ));

        return $this->renderComponent();
    }

    public function executeEdit() {
    }

    public function executeLoadCustomFieldFrm() {
        $category_id = $this->request()->post('category_id');

        $category = Terms::retrieveById($category_id);
        if (!$category) {
            //error
            return $this->renderText('');
        }

        $item_id = $this->request()->post('item_id');

        //load category custom fields
        $categoryCfs = TermCustomFields::findByTermId($category_id);
        if (empty($categoryCfs)) {
            return $this->renderText('');
        }

        /** @var ItemCustomFields[] $itemCfs */
        $itemCfs = array();

        //load item custom field value if exist
        if ($item_id) {
            $_itemCfs = ItemCustomFields::findByItemId($item_id);
            for ($i = 0, $size = sizeof($_itemCfs); $i < $size; ++$i) {
                $itemCfs[$_itemCfs[$i]->getCfId()] = $_itemCfs;
            }

            unset($_itemCfs);
        }
        //end load item custom field value

        $data = array();
        foreach ($categoryCfs as $catCf) {
            $d = (object) $catCf->toArray();
            $d->value = '';

            if (isset($itemCfs[$catCf->getId()])) {//exist items
                $i = $itemCfs[$catCf->getId()];
                switch($catCf->getFormat()) {
                    case 'NUMBER':
                        $d->value = (float) $i->getNumberValue();
                        break;
                    case 'BOOL':
                        $d->value = (bool) $i->getBoolValue();
                        break;
                    case 'DATETIME':
                        $d->value = $i->getDatetimeValue();
                        break;
                    default:
                        $d->value = $i->getTextValue();
                }
            }

            $data[] = $d;
        }

        $data = Plugin::applyFilters('custom_' .$category->getTaxonomy() .'_cf_form_data', $data);

        $buf = $this->renderPartial(array(
            'data' => $data
        ));

        $buf = Plugin::applyFilters('custom_' .$category->getTaxonomy() .'_cf_form', $buf);

        return $buf;
    }

    protected function _save(Items &$item, &$error) {
        $input = $this->request()->post('items', 'ARRAY', array());

        $isNew = $item->isNew();

        $item->hydrate($input);

        $item->beginTransaction();
        if ($item->save()) {
            if ($isNew) {
                //save item's images
                $imgs = $this->request()->post('imgs', 'ARRAY', array());
                foreach ($imgs as $index => $img) {
                    $itemImg = new ItemImages();
                    $itemImg->setPath($img);
                    $itemImg->setCaption($this->request()->post('img_caption_'.$index));
                    $itemImg = Plugin::applyFilters('process_item_'.$item->taxonomy .'_img', $itemImg);
                    $itemImg->save();
                }
                //end save item images

                //save attachments
                $attachments = $this->request()->post('attachments', 'ARRAY', array());
                foreach ($attachments as $attachment) {
                    $itemAttachment = new ItemAttachments();
                    $file = MEDIA_DIR .'attachments' .DIRECTORY_SEPARATOR .$attachment;
                    $mime = mime_content_type($file);
                    $itemAttachment->setFile($attachment);
                    $itemAttachment->setFile($mime);
                    $itemAttachment->save();
                }
                //end save attachments
            }

            //save custom fields

            //end save custom fields

            //save properties

            //end save properties

            $item->commit();
            return true;
        } else {
        }

        $item->setNew(true);
        $item->rollBack();
        return false;
    }
}