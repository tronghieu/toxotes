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
        $post = new Posts();
        $post->setIsDraft(true);
        $post->save(false); //save Draft before
        $this->setView('form');

        $this->view()->assign(array(
            'post' => $post,
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

        $post_id = $this->request()->post('post_id');

        //load category custom fields
        $categoryCfs = TermCustomFields::findByTermId($category_id);
        if (empty($categoryCfs)) {
            return $this->renderText('');
        }

        /** @var PostCustomFields[] $postCfs */
        $postCfs = array();

        //load item custom field value if exist
        if ($post_id) {
            $_postCfs = PostCustomFields::findByItemId($post_id);
            for ($i = 0, $size = sizeof($_postCfs); $i < $size; ++$i) {
                $postCfs[$_postCfs[$i]->getCfId()] = $_postCfs;
            }

            unset($_postCfs);
        }
        //end load item custom field value

        $data = array();
        foreach ($categoryCfs as $catCf) {
            $d = (object) $catCf->toArray();
            $d->value = '';

            if (isset($postCfs[$catCf->getId()])) {//exist items
                $i = $postCfs[$catCf->getId()];
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

    protected function _save(Posts &$post, &$error) {
        $input = $this->request()->post('posts', 'ARRAY', array());

        $isNew = $post->isNew();

        $post->hydrate($input);

        $post->beginTransaction();
        if ($post->save()) {
            if ($isNew) {
                //save item's images
                $imgs = $this->request()->post('imgs', 'ARRAY', array());
                foreach ($imgs as $index => $img) {
                    $postImg = new PostImages();
                    $postImg->setPath($img);
                    $postImg->setCaption($this->request()->post('img_caption_'.$index));
                    $postImg = Plugin::applyFilters('process_post_'.$post->taxonomy .'_img', $postImg);
                    $postImg->save();
                }
                //end save item images

                //save attachments
                $attachments = $this->request()->post('attachments', 'ARRAY', array());
                foreach ($attachments as $attachment) {
                    $postAttachment = new PostAttachments();
                    $file = MEDIA_DIR .'attachments' .DIRECTORY_SEPARATOR .$attachment;
                    $mime = mime_content_type($file);
                    $postAttachment->setFile($attachment);
                    $postAttachment->setFile($mime);
                    $postAttachment->save();
                }
                //end save attachments
            }

            //save custom fields

            //end save custom fields

            //save properties

            //end save properties

            $post->commit();
            return true;
        } else {
        }

        $post->setNew(true);
        $post->rollBack();
        return false;
    }
}