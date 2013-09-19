<?php
use Flywheel\Validator\EmailValidator;
use Toxotes\Cms;

class ContactController extends FrontendBaseController {
    public function executeDefault() {
        $contact = Posts::read()->where('`taxonomy` = :taxo
                        AND `is_draft` = 0
                        AND `language` = :lang')
                    ->setParameter(':taxo', 'contacts')
                    ->setParameter(':lang', $this->currentLang->getLangCode())
                    ->setMaxResults(1)
                    ->execute()
                    ->fetchObject(Posts::getPhpName(), array(null, false));

        $this->view()->assign(array(
            'contact' => $contact
        ));
        return $this->renderComponent();
    }

    public function executeMess() {
        $this->validAjaxRequest();
        $mess = $this->request()->post('message', 'ARRAY', array());

        $error = array();
        if (!isset($mess['name']) || !isset($mess['email'])
            || !isset($mess['subject']) || !isset($mess['content'])) {
            $error['name'] = Cms::t('Name is required');
            $error['email'] = Cms::t('Email is required');
            $error['subject'] = Cms::t('Subject is required');
            $error['content'] = Cms::t('Content is required');
        }

        if (empty($error)) {
            $emailValidator = new EmailValidator();
            if (!$emailValidator->isValid(null, $mess['email'])) {
                $error['email'] = Cms::t('Invalid email format');
            }

            if (mb_strlen($mess['content']) < 10) {
                $error['content'] = Cms::t('Content too short');
            }

            if (mb_strlen($mess['subject']) < 3) {
                $error['subject'] = Cms::t('Email subject too short');
            }

            if (mb_strlen($mess['name']) <10) {
                $error['name'] = Cms::t('Name too short');
            }
        }

        $res = new AjaxResponse();

        if (!empty($error)) {
            $res->type = AjaxResponse::ERROR;
            $res->message = $error;
            return $this->renderText($res->toString());
        }

        //send mail here
        $contact = Posts::retrieveById($this->request()->post('contact_id', 'INT', 0));
        if (!$contact) {
            $res->type = AjaxResponse::ERROR;
            $res->message = array('All' => Cms::t('Contact not found'));
            return $this->renderText($res->toString());
        }

        $linked_user = $contact->getProperty('linked_user');
        if ($linked_user && ($user = Users::retrieveById($linked_user->getValue()))) {
            if (MailSender::send($user->getEmail(), $mess['subject'], $mess['content'], $mess['email'], $mess['name'])) {
                if ($this->request()->post('send_you', 'BOOLEAN', false)) {
                    MailSender::send($mess['email'], 'Copy of ' .$mess['subject'], $mess['content'], $mess['email'], $mess['name']);
                }

                $res->type = AjaxResponse::SUCCESS;
                $res->message = Cms::t('Email sent');
                return $this->renderText($res->toString());
            }
        } else {
            $res->type = AjaxResponse::ERROR;
            $res->message = array('All' => 'We are so sorry, something was wrong');
            return $this->renderText($res->toString());
        }

        $res->type = AjaxResponse::ERROR;
        $res->message = array('All' => 'Unknown error');
        return $this->renderText($res->toString());
    }
}