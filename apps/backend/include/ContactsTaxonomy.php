<?php

use Flywheel\Html\Form;
use Toxotes\Plugin;

class ContactsTaxonomy {
    public static function init() {
        Plugin::registerTaxonomy('contacts', 'post', array(
            'label' => t('Contacts'),
            'term_taxonomy' => 'contacts_group',
            'enable_attachments' => false
        ));

        Plugin::addFilter('get_category_contacts', array('ContactsTaxonomy', 'getGroupTerm'));
        Plugin::addFilter('custom_before_contacts_publish_box', array('ContactsTaxonomy', 'selectForm'), 1, 3);
        Plugin::addFilter('verify_contacts_form_data', array('ContactsTaxonomy', 'verifyForm'));
        Plugin::addFilter('handling_contacts_form_data', array('ContactsTaxonomy', 'handlingForm'));
    }

    public static function getGroupTerm($taxonomy) {
        return 'contacts_group';
    }

    /**
     * @param \Posts $post
     * @param Form $from
     * @param $error
     */
    public static function selectForm($post, $from, $error) {
        $users = Users::findByStatus(1);

        $selected = \Flywheel\Factory::getRequest()->post('linked_user', 'INT', 0);
        if (!$selected && !$post->isNew()) {
            $linkedUserProp = $post->getProperty('linked_user');
            if ($linkedUserProp) {
                $selected = $linkedUserProp->getValue();
            }
        }

        ob_start();
        ?>
        <div class="box box-bordered">
            <div class="box-title">
                <h3>
                    <?php td('Linked User'); ?>
                </h3>
            </div>
            <div class="box-content">
                <div class="control-group<?php if(isset($error['linked_user'])) echo ' error' ?>" style="margin-top: 10px;">
                    <?php
                    $s = $from->selectOption('linked_user', $selected)
                        ->addOption(t('Select user'), 0);
                    foreach ($users as $user) {
                        $s->addOption($user->getUsername(), $user->getId());
                    }
                    $s->display();
                    ?>
                    <?php if (isset($error['linked_user'])) : ?>
                        <span class="help-block"><?php echo $error['linked_user'] ?></span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
        $s = ob_get_clean();
        echo $s;
    }

    public static function verifyForm($error) {
        $linked_user = \Flywheel\Factory::getRequest()->post('linked_user', 'INT', 0);
        if (!$linked_user || !($user = Users::retrieveById($linked_user))) {
            $error['linked_user'] = 'User must chose user';
        }

        return $error;
    }

    /**
     * @param Posts $post
     * @return Posts
     */
    public static function handlingForm($post) {
        $error = array();
        $linked_user = \Flywheel\Factory::getRequest()->post('linked_user', 'INT', 0);
        if (!$linked_user || !($user = Users::retrieveById($linked_user))) {
            $error['linked_user'] = 'User must chose user';
        }

        if (empty($error)) {
            $linkedUserProp = $post->getProperty('linked_user');
            if (!$linkedUserProp) {
                $linkedUserProp = new PostProperty();
                $linkedUserProp->setProperty('linked_user');
                $linkedUserProp->setPostId($post->getId());
                $linkedUserProp->setValueType(PostProperty::INT);
            }
            $linkedUserProp->setIntValue($user->getId());
            $linkedUserProp->save();
        }

        return $post;
    }
}