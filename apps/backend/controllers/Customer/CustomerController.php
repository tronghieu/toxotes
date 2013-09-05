<?php
use Flywheel\Factory;

class CustomerController extends AdminBaseController {

    public function executeDefault() {
    }

    public function executeAddContact() {
        $error = array();
        if (($id = $this->request()->get('id', 'INT', 0))) {
            $contact = Contacts::retrieveById($id);
        } else {
            $contact = new Contacts();
        }

        $isNew = $contact->isNew();

        if ($this->request()->isPostRequest()) {
            //handling post
            $contact->hydrate($this->request()->post('contacts', 'ARRAY', array()));
            $groups = $this->request()->post('groups', 'ARRAY', array());
            if($contact->save()) {
                foreach($groups as $g) {
                    $contactGroupMap = ContactGroupMap::findOneByContactIdAndGroupId($contact->getId(), $g);
                    if (!$contactGroupMap) {
                        $contactGroupMap = new ContactGroupMap();
                    }

                    $contactGroupMap->setGroupId($g);
                    $contactGroupMap->setContactId($contact->getId());
                    $contactGroupMap->save(false);
                }

                Factory::getSession()->setFlash('customer_message', $contact->getName() .t(' was saved!'));
                $this->redirect($this->createUrl('customer/default'));
            } else if (!$contact->isValid()) {
                foreach ($contact->getValidationFailures() as $validationFailure) {
                    $error[$validationFailure->getColumn()] = $validationFailure->getMessage();
                }
            }

        }

        $this->view()->assign(array(
            'is_new' => $isNew,
            'contact' => $contact,
            'error' => $error
        ));

        $this->setView('add_contact');
        return $this->renderComponent();
    }

    public function executeAddGroup() {
        $this->validAjaxRequest();

        if (!$this->request()->isPostRequest()) {
            \Flywheel\Base::end('Invalid request!');
        }

        $error = array();

        $ajax = new AjaxResponse();
        $group = new ContactGroup();
        $group->setName($this->request()->post('group_name'));
        if ($group->save()) {
            $ajax->type = AjaxResponse::SUCCESS;
            $ajax->group = $group->toArray();
        } else {
            if (!$group->isValid()) {
                foreach($group->getValidationFailures() as $validationFailure) {
                    $error[] = $validationFailure->getMessage();
                }

                $error = implode(',', $error);
                $ajax->error = $error;
            }

            $ajax->type = AjaxResponse::ERROR;
        }

        return $this->renderText($ajax->toString());
    }

    public function createMail() {
        if (!($id = $this->request()->get('id', 'INT', 0))) {
            $mailMessage = new MailMessage();
            $mailMessage->setIsDraft(true);
            $mailMessage->save(false);
            $this->redirect(
                $this->createUrl('contant_management/createMail', array(
                    'id' => $mailMessage->getId())));
        }

        $error = array();

        if ($this->request()->isPostRequest()) {
            $mailMessage = MailMessage::retrieveById($this->request()->post('mm_id'));
            $mailMessage->hydrate($this->request()->post('mm_data', 'ARRAY', array()));
            $persons = $this->request()->post('u_recipient');
            $groups = $this->request()->post('groups');
            $recipient = array(
                'persons' => $persons,
                'groups' => $groups
            );

            $mailMessage->setRecipients(json_encode($recipient));
        }

        $this->setView('mail_form');
        return $this->renderComponent();
    }

    public function executeSendMail() {}
}