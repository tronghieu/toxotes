<?php
use Flywheel\Event\Event;
use Flywheel\Html\Form;

/**
 * Created by JetBrains PhpStorm.
 * User: nobita
 * Date: 5/22/13
 * Time: 10:20 AM
 * To change this template use File | Settings | File Templates.
 */

class SimpleEvent {
    public $propertyValueMap = array();

    public function addMenu(Event $event) {
        /** @var BackendSidebar $owner */
        $owner = $event->sender;
        $owner->items[] = array(
            'label' => t('Training/Events'),
            'url' => array('post/default', 'taxonomy' => 'event_manager'),
            'items' => array(
                array('label' => t('Events'),
                    'url' => array('post/default', 'taxonomy' => 'event_manager')
                ),

                array('label' => t('Add Event'),
                    'url' => array('post/create', 'taxonomy' => 'event_manager')
                ),
                array('label' => t('Event Categories'),
                    'url' => array('category/default', 'taxonomy' => 'event_manager')
                ),
            ),
        );
    }

    public function afterCreateTerm(Event $event) {
        $term = $event->params['term'];
    }

    public function customTermColumn($columns) {
        $columns['event'] = array(
            'label' => t('Events')
        );

        return $columns;
    }

    /**
     * @param \Posts $post
     * @param Form $from
     * @param $error
     */
    public function eventTimeForm($post, $from, $error) {
        $properties = array(
            'event_start_date' => array('',''),
            'event_end_date' => array('', ''),
            'all_day' => false,
        );

        if (!$post->isNew()) {
            $postProperties = PostPeer::getPostProperties($post->getId());
            if (isset($postProperties['event_start_date'])) {
                $properties['event_start_date'] = explode(' ', $postProperties['event_start_date']->getValue()->format('dd/mm/YYYY H:i:s'));
            }

            if (isset($postProperties['event_end_date'])) {
                $properties['event_end_date'] = explode(' ', $postProperties['event_end_date']->getValue()->format('dd/mm/YYYY H:i:s'));
            }

            if (isset($postProperties['event_all_day'])) {
                $properties['all_day'] = $postProperties['event_all_day']->getValue();
            }
        }

        ob_start();
        ?>
        <div class="span6">
            <h4><?php td('When'); ?></h4>
            <div class="control-group<?php if(isset($error['event_start_date'])) echo ' error' ?>" style="margin-top: 10px;">
                <label class="control-label"><strong><?php td('From'); ?></strong></label>
                <div class="controls">
                    <?php td('Date'); ?> <input type="text" name="event_start_date" id="event_start_date" value="<?php echo $properties['event_start_date'][0]; ?>" class="input-small datepick">
                    <?php td('at'); ?>
                    <div class="bootstrap-timepicker" style="display: inline">
                        <input type="text" name="event_start_time" id="event_start_time" value="<?php echo $properties['event_start_date'][1]; ?>" class="input-mini timepick" data-show-meridian="false">
                    </div>
                    <?php if (isset($error['event_start_date'])) : ?>
                        <span class="help-block"><?php echo $error['event_start_date'] ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="control-group<?php if(isset($error['event_end_date'])) echo ' error' ?>">
                <label class="control-label"><strong><?php td('To'); ?></strong></label>
                <div class="controls">
                    <?php td('Date'); ?> <input type="text" name="event_end_date" id="event_end_date" value="<?php echo $properties['event_end_date'][0]; ?>" class="input-small datepick">
                    <?php td('at'); ?>
                    <div class="bootstrap-timepicker" style="display: inline">
                        <input type="text" name="event_end_time" id="event_end_time" value="<?php echo $properties['event_end_date'][1]; ?>" class="input-mini timepick" data-show-meridian="false">
                    </div>
                    <?php if (isset($error['event_end_date'])) : ?>
                        <span class="help-block"><?php echo $error['event_end_date'] ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="control-group<?php if(isset($error['event_all_day'])) echo ' error' ?>">

                <div class="controls">
                    <label class="checkbox inline" style="padding-left: 0"><strong><?php td('All day event ?'); ?></strong></label>
                    <input name="event_all_day" type="checkbox" value="1"<?php if($properties['all_day']) :?> checked="checked"<?php endif; ?>>
                    <?php if (isset($error['event_all_day'])) : ?>
                        <span class="help-block"><?php echo $error['event_all_day'] ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <div>
                <?php td('This event spans every day between the beginning and end date, with start/end times applying to each day.'); ?>
            </div>
        </div>
        <?php
        $s = ob_get_clean();
        echo $s;
    }

    /**
     * @param Posts $post
     * @param Form $form
     * @param $error
     */
    public function eventLocationForm($post, $form, $error) {
        $properties = array();
        $properties['event_location_name'] = array(
            'label' => t('Location Name'),
        );
        $properties['event_location_address'] = array(
            'label' => t('Address'),
        );
        $properties['event_location_city'] = array(
            'label' => t('City/Town'),
        );


        if (!$post->isNew()) {
            $postProperties = PostPeer::getPostProperties($post->getId());
            if (isset($postProperties['event_location_name'])) {
                $properties['event_location_name']['value'] = $postProperties['event_location_name']->getValue();
            }

            if (isset($postProperties['event_location_address'])) {
                $properties['event_location_address']['value'] = $postProperties['event_location_address']->getValue();
            }

            if (isset($postProperties['event_location_city'])) {
                $properties['event_location_city']['value'] = $postProperties['event_location_city']->getValue();
            }
        }

        ob_start();
        ?>
        <div class="row-fluid">
            <div class="span4" style="margin-top: 20px;">
                <h4><?php td('Event Location'); ?></h4>
                <?php foreach ($properties as $key => $v) :?>
                    <div class="control-group<?php if(isset($error[$key])) echo ' error' ?>">
                        <label class="control-label"><strong><?php echo $v['label'] ?> (*)</strong></label>
                        <div class="controls">
                            <?php if ('event_location_address' == $key) :?>
                                <textarea name="<?php echo $key ?>" id="<?php echo $key ?>" class="input-block-level"><?php echo @$v['value'] ?></textarea>
                            <?php else : ?>
                                <input type="text" name="<?php echo $key ?>" id="<?php echo $key ?>" value="<?php echo @$v['value'] ?>" class="input-block-level">
                            <?php endif; ?>
                            <?php if (isset($error[$key])) : ?>
                                <span class="help-block"><?php echo $error[$key] ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="span8" style="margin-top: 10px;">
                <div id="event_map"></div>
            </div>
        </div>
        <?php
        $s = ob_get_clean();
        echo $s;
    }

    /**
     * @param Posts $post
     * @param Form $form
     * @param $error
     */
    public function eventContactForm($post, $form, $error) {
        $properties = array();
        $properties['event_contact_name'] = array(
            'label' => t('Contact Name'),
        );
        $properties['event_contact_address'] = array(
            'label' => t('Contact Address'),
        );
        $properties['event_contact_phone'] = array(
            'label' => t('Contact Phone'),
        );
        $properties['event_contact_fax'] = array(
            'label' => t('Contact Fax'),
        );
        $properties['event_contact_email'] = array(
            'label' => t('Contact Email'),
        );


        if (!$post->isNew()) {
            $postProperties = PostPeer::getPostProperties($post->getId());
            if (isset($postProperties['event_contact_name'])) {
                $properties['event_contact_name']['value'] = $postProperties['event_contact_name']->getValue();
            }

            if (isset($postProperties['event_contact_address'])) {
                $properties['event_contact_address']['value'] = $postProperties['event_contact_address']->getValue();
            }

            if (isset($postProperties['event_contact_phone'])) {
                $properties['event_contact_phone']['value'] = $postProperties['event_contact_phone']->getValue();
            }

            if (isset($postProperties['event_contact_fax'])) {
                $properties['event_contact_fax']['value'] = $postProperties['event_contact_fax']->getValue();
            }

            if (isset($postProperties['event_contact_email'])) {
                $properties['event_contact_email']['value'] = $postProperties['event_contact_email']->getValue();
            }
        }

        ob_start();
        ?>
        <div class="span6">
            <h5><?php td('Contact'); ?></h5>
            <?php foreach ($properties as $key => $v) :?>
                <div class="control-group<?php if(isset($error[$key])) echo ' error' ?>">
                    <label class="control-label"><strong><?php echo $v['label'] ?></strong></label>
                    <div class="controls">
                        <input type="text" name="<?php echo $key ?>" id="<?php echo $key ?>" value="<?php echo @$v['value'] ?>" class="input-block-level">
                        <?php if (isset($error[$key])) : ?>
                            <span class="help-block"><?php echo $error[$key] ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
        $s = ob_get_clean();
        echo $s;
    }

    public function form($post, $from, $error) {
        ?>
        <div class="row-fluid">
            <div class="box">
                <div class="box-title nopadding"><h3><?php td('Events Information'); ?></h3></div>
                <div class="box-content">
                    <?php
                        $this->eventTimeForm($post, $from, $error);
                        $this->eventContactForm($post, $from, $error);
                        $this->eventLocationForm($post, $from, $error);
                    ?>
                </div>
            </div>
        </div>
        <?php
    }
}