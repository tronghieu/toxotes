<?php

use Toxotes\Plugin;

class ContactsTaxonomy {
    public static function init() {
        Plugin::registerTaxonomy('contacts', 'post', array(
            'label' => t('Contacts'),
            'term_taxonomy' => 'contacts_group',
            'enable_attachments' => false
        ));

        Plugin::addFilter('get_category_contacts', array('ContactsTaxonomy', 'getGroupTerm'));
    }

    public static function getGroupTerm($taxonomy) {
        return 'contacts_group';
    }
}