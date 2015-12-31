<?php
namespace CMSBackend\Controller;


use CMSBackend\Event\CMSBackendEvent;
use Flywheel\Db\Type\DateTime;
use Flywheel\Filesystem\Uploader;
use Flywheel\Session\Session;
use Flywheel\Util\Folder;
use Flywheel\Util\Sanitize;

class Items extends CMSBackendBase {

    public function executeDefault()
    {
        $keyword = $this->get('keyword');
        $cat_id = $this->get('cat_id');
        $is_hot = $this->get('is_hot');
        $promotion = $this->get('promotion');
        $page = $this->get('page', 'INT', 1);

        if ($this->request()->isXmlHttpRequest()) {
            $ajax = new \AjaxResponse();
            $q = \Items::read();
            if ($keyword) {
                $q->where('`name` LIKE :k OR `slug` LIKE :k')
                    ->setParameter(':k', "%{$keyword}%", \PDO::PARAM_STR);
            }

            if ($cat_id) {
                $q->andWhere('`cat_id` = :cat_id')
                    ->setParameter(':cat_id', $cat_id, \PDO::PARAM_INT);
            }

            if ($is_hot) {
                $q->andWhere('`pin` = 1');
            }

            if ($promotion) {
                $q->andWhere('`promotion` = 1');
            }

            $cq = clone $q;
            $total = $cq->count('`id`')
                ->execute();

            $stmt = $q->setMaxResults(30)
                ->setFirstResult(30*($page-1))
                ->execute();

            $result = [];
            while($om = $stmt->fetchObject(\Items::getPhpName(), [null, false])) {
                /** @var \Items $om */
                $t = $om->toArray();
                $t['cat'] = \Terms::retrieveById($om->getCatId());
                if ($t['cat']) {
                    $t['cat'] = $t['cat']->toArray();
                }
                $t['thumb_url'] = $om->getMainImgThumb(96);
                $t['edit_link'] = $this->createUrl('items/edit', ['id' => $om->getId()]);
                $t['remove_link'] = $this->createUrl('items/remove', ['id' => $om->getId()]);
                $result[] = $t;
            }
            $ajax->type = \AjaxResponse::SUCCESS;
            $ajax->items = $result;
            $ajax->current_page = $page;
            $ajax->total_page = ceil($total/30);

            return $this->renderText($ajax->toString());
        }

        $this->document()->addJsVar('items_list_url', $this->createUrl('items'));

        $this->setView('Items/list_items');
        $this->view()->assign([
            'keyword' => $keyword,
            'cat_id' => $cat_id,
            'is_hot' => $is_hot,
            'promotion' => $promotion,
            'page' => $page
        ]);

        return $this->renderComponent();
    }

    public function executeCreate() {
        $item = new \Items();
        $item->setIsDraft(1);
        $item->save(false); //save Draft before
        $this->redirect($this->createUrl('items/edit', ['id' => $item->getId()]));
    }

    public function executeEdit() {
        $this->setView('Items/form');
        $id = $this->get('id');

        if (!$id || !($item = \Items::retrieveById($id))) {
            return $this->raise403(t('Item not found'));
        }

        $error = [];
        $message = Session::getInstance()->getFlash('item_frm');
        //submit
        if ($this->request()->isPostRequest()) {
            $is_new = $item->isNew();
            $data = $this->post('item', 'ARRAY', []);
            $data['regular_price'] = floatval(str_replace(',', '.', str_replace('.', '', @$data['regular_price'])));
            $data['sale_price'] = floatval(str_replace(',', '.', str_replace('.', '', @$data['sale_price'])));
            $data['description'] = Sanitize::stripScripts($data['description']);

            //save images
            /*$images_post = $this->post('item_images', 'ARRAY', []);
            $imgs = [];
            $main_img_found = false;
            $first_key = '';
            $index = 0;
            foreach($images_post as $file_name => $img_data) {
                if ($index == 0) {
                    $first_key = $file_name;
                }
                $main_img_found = $img_data['main'];
                $imgs[$file_name] = $img_data;
                $index++;
            }

            if(!$main_img_found) {
                $imgs[$first_key]['main'] = true;
            }*/

            $item->hydrate($data);
            $is_draft = $item->isDraft();
//            $item->setImgs(json_encode($imgs));
            if($item->isDraft()) {
                $item->setIsDraft(false);
                $item->setPublicTime(new DateTime());
            }

            if (empty($error)) {
                if ($item->save()) {
                    Session::getInstance()->setFlash('item_frm', $item->getName() .' was saved!');
                    $this->dispatch($is_new? 'onAfterCreateItems':'onAfterUpdateItems', new CMSBackendEvent($this, [
                        'item' => $item
                    ]));
                    $this->redirect($this->createUrl('items/edit', ['id' => $item->getId()]));
                } elseif(!$item->isValid()) {
                    $item->setIsDraft($is_draft);
                    foreach($item->getValidationFailures() as $fail) {
                        $error[$fail->getColumn(false)] = t($fail->getMessage());
                    }
                }
            }
        }

        $item_data = $item->toArray();
        $item_img = $item->getImages();
        foreach($item_img as &$img) {
            $img['url'] = rtrim($this->document()->getBaseUrl(), '/') .preg_replace('/(\/+)/','/', '/../'.$img['path']);
            $img['thumb_url'] = \Items::getImgThumbFromPath($img['path'], 52);
        }

        $item_data['imgs'] = $item_img;

        //js url
        $this->document()->addJsVar('upload_url', $this->createUrl('items/upload'));
        $this->document()->addJsVar('remove_img_url', $this->createUrl('items/remove_img'));
        $this->document()->addJsVar('set_main_img_url', $this->createUrl('items/set_main_image'));
        $this->document()->addJsVar('item', $item_data);

        $this->view()->assign([
            'item' => $item,
            'error' => $error,
            'message' => $message
        ]);

        return $this->renderComponent();
    }

    public function executeUpload()
    {
        $upload_max_filesize = str_replace('M', '', ini_get('upload_max_filesize'));
        $res = new \AjaxResponse();
        $res->type = \AjaxResponse::ERROR;
        $item_id = $this->request()->post('item_id');

        if (!$item_id || !($item = \Items::retrieveById($item_id))) {
            $res->message = t('Items not found');
            return $this->renderText($res->toString());
        }

        $upload_dir = PUBLIC_DIR .'/media/product_img/';
        Folder::create($upload_dir, 0755);
        $error = array();

        $fileUploader = new Uploader($upload_dir, 'file_upload');
        $fileUploader->setMaximumFileSize($upload_max_filesize);
        $fileUploader->setFilterType('.jpg, .jpeg, .png, .bmp, .gif');
        $fileUploader->setIsEncryptFileName(true);
        if ($fileUploader->upload('upload_images')) {
            $data = $fileUploader->getData();
            $file_path = '/media/product_img/' .$data['file_name'];
            $file_url = rtrim($this->document()->getBaseUrl(), '/'). preg_replace('/(\/+)/','/', '/../' .$file_path);

            $image = [
                'file_name' => $data['file_name'],
                'thumb_url' => \Items::getImgThumbFromPath($file_path, 52),
                'url' => $file_url,
                'path' => $file_path,
                'ordering' => 0,
                'public' => true,
            ];

            if (!$item->getMainImgData()) {
                $image['main'] = true;
            }
            $other_img = $item->getImages();
            $last = array_pop($other_img);
            if ($last) {
                $image['ordering'] = ((int) @$last['ordering']) + 1;
            }
            $item->addImage($image);
            $item->save(false);

            $res->type = \AjaxResponse::SUCCESS;
            $res->image = $image;
            return $this->renderText($res->toString());
        } else {
            $error['upload'] = $fileUploader->getError();
        }

        $res->error = $error;
        return $this->renderText($res->toString());
    }

    public function executeRemoveImg()
    {
        $file_name = $this->post('file_name');
        $item_id = $this->post('item_id');
        $res = new \AjaxResponse();
        $res->type = \AjaxResponse::ERROR;
        if (!$item_id || !($item = \Items::retrieveById($item_id))) {
            $res->message = t('Items not found');
            return $this->renderText($res->toString());
        }

        if ($file_name) {
            $file_path = MEDIA_DIR .'/product_img/' .$file_name;
            Folder::clean($file_path);
            $item->removeImage($file_name);
            if ($item->save(false)) {
                @unlink($file_path);
                $res->message = t('OK!');
                $res->type = \AjaxResponse::SUCCESS;
            } else {
                $res->message = t('Something went wrong, could not remove image');
            }
        }

        $item_img = $item->getImages();
        foreach($item_img as &$img) {
            $img['url'] = rtrim($this->document()->getBaseUrl(), '/') .preg_replace('/(\/+)/','/', '/../'.$img['path']);
            $img['thumb_url'] = \Items::getImgThumbFromPath($img['path'], 52);
        }
        $res->images = $item_img;
        return $this->renderText($res->toString());
    }

    public function executeSetMainImage()
    {
        $file_name = $this->post('file_name');
        $item_id = $this->post('item_id');
        $res = new \AjaxResponse();
        $res->type = \AjaxResponse::ERROR;
        if (!$item_id || !($item = \Items::retrieveById($item_id))) {
            $res->message = t('Items not found');
            return $this->renderText($res->toString());
        }

        if ($file_name) {
            $item->setMainImage($file_name);
            $item->save(false);
            $res->type = \AjaxResponse::SUCCESS;
        }

        $item_img = $item->getImages();
        foreach($item_img as &$img) {
            $img['url'] = rtrim($this->document()->getBaseUrl(), '/') .preg_replace('/(\/+)/','/', '/../'.$img['path']);
            $img['thumb_url'] = \Items::getImgThumbFromPath($img['path'], 52);
        }
        $res->images = $item_img;
        return $this->renderText($res->toString());
    }

    public function executeRemove()
    {
        $this->validAjaxRequest();
        $res = new \AjaxResponse();
        $res->type = \AjaxResponse::ERROR;
        $item_id = $this->get('id');
        if (!$item_id || !($item = \Items::retrieveById($item_id))) {
            $res->message = t('Item not found!');
            return $this->renderText($res->toString());
        }

        if ($item->delete()) {
            $res->message = t('Item was removed!');
            $res->type = \AjaxResponse::SUCCESS;
            $res->item_id = $item_id;
        }

        return $this->renderText($res->toString());
    }
}