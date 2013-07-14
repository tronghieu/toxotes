<?php
use Flywheel\Db\Type\DateTime;
use Flywheel\Event\Event;
use Flywheel\Factory;
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
        $request = Factory::getRequest();

        if ($request->isPostRequest()) {
            $properties['event_start_date'] = array($request->post('event_start_date'), $request->post('event_start_time'));
            $properties['event_end_date'] = array($request->post('event_end_date'), $request->post('event_end_time'));
            $properties['all_day'] = $request->post('event_all_day');
        } else if (!$post->isNew()) {
            $postProperties = PostPeer::getPostProperties($post->getId());
            if (isset($postProperties['event_start_date'])) {
                $properties['event_start_date'] = explode(' ', $postProperties['event_start_date']->getValue()->format('d/m/Y H:i'));
            }

            if (isset($postProperties['event_end_date'])) {
                $properties['event_end_date'] = explode(' ', $postProperties['event_end_date']->getValue()->format('d/m/Y H:i'));
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
                    <?php td('Date'); ?> <input type="text" name="event_start_date" id="event_start_date" value="<?php echo $properties['event_start_date'][0]; ?>" class="input-small datepick" data-date-format="dd/mm/yyyy">
                    <?php td('at'); ?>
                    <div class="bootstrap-timepicker" style="display: inline">
                        <input type="text" name="event_start_time" id="event_start_time" value="<?php echo $properties['event_start_date'][1]; ?>" class="input-mini timepick" data-show-meridian="false" data-default-time="false">
                    </div>
                    <?php if (isset($error['event_start_date'])) : ?>
                        <span class="help-block"><?php echo $error['event_start_date'] ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="control-group<?php if(isset($error['event_end_date'])) echo ' error' ?>">
                <label class="control-label"><strong><?php td('To'); ?></strong></label>
                <div class="controls">
                    <?php td('Date'); ?> <input type="text" name="event_end_date" id="event_end_date" value="<?php echo $properties['event_end_date'][0]; ?>" class="input-small datepick" data-date-format="dd/mm/yyyy">
                    <?php td('at'); ?>
                    <div class="bootstrap-timepicker" style="display: inline">
                        <input type="text" name="event_end_time" id="event_end_time" value="<?php echo $properties['event_end_date'][1]; ?>" class="input-mini timepick" data-show-meridian="false" data-default-time="false">
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

        $request = Factory::getRequest();

        if ($request->isPostRequest()) {
            $properties['event_location_name']['value'] = $request->post('event_location_name');
            $properties['event_location_address']['value'] = $request->post('event_location_address');
            $properties['event_location_city']['value'] = $request->post('event_location_city');
        } else if (!$post->isNew()) {
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
                        <label class="control-label"><strong><?php echo $v['label'] ?></strong></label>
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

        $request = Factory::getRequest();

        if ($request->isPostRequest()) {
            $properties['event_contact_name']['value'] = $request->post('event_contact_name');
            $properties['event_contact_address']['value'] = $request->post('event_contact_address');
            $properties['event_contact_phone']['value'] = $request->post('event_contact_phone');
            $properties['event_contact_fax']['value'] = $request->post('event_contact_fax');
            $properties['event_contact_email']['value'] = $request->post('event_contact_email');
        } else if (!$post->isNew()) {
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
                        <?php if ('event_contact_address' == $key) :?>
                            <textarea class="input-block-level" rows="3" name="<?php echo $key?>" id="<?php echo $key ?>"><?php echo @$v['value']?></textarea>
                        <?php else :?>
                            <input type="text" name="<?php echo $key ?>" id="<?php echo $key ?>" value="<?php echo @$v['value'] ?>" class="input-block-level">
                            <?php if (isset($error[$key])) : ?>
                                <span class="help-block"><?php echo $error[$key] ?></span>
                            <?php endif; ?>
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

    public function verifyForm($error) {
        $request = Factory::getRequest();
        $start_date = $request->post('event_start_date');
        $end_date = $request->post('event_end_date');
        $all_day = $request->post('event_all_day');
        $start_time = $request->post('event_start_time');
        $end_time = $request->post('event_end_time');
        $location_name = $request->post('event_location_name');
        $location_address = $request->post('event_location_address');

        $start_time = ($start_time)? $start_time : '00:00';
        $end_time = ($end_time)? $end_time : '00:00';

        if ($start_date) {
            $sd = DateTime::createFromFormat('d/m/Y H:i', $start_date. ' ' .$start_time);
            if (!$sd) {
                $error['event_start_date'] = t('Invalid event start time');
            }
        } else {
            $error['event_start_date'] = t('Start date is required');
        }

        if ($end_date) {
            $ed = DateTime::createFromFormat('d/m/Y H:i', $end_date . ' ' .$end_time);
            if (!$ed) {
                $error['event_end_date'] = t('Invalid event end time');
            }
        }

        if (!$all_day && !$end_date) {
            $error['event_end_date'] = t('End date is required');
        }

        if (isset($sd) && isset($ed)) {
            if ($ed < $sd) {
                $error['event_end_date'] = t('Invalid event end time');
            }
        }

        if (!$location_name) {
            $error['event_location_name'] = t('Location name can not be empty');
        }

        if (!$location_address) {
            $error['event_location_address'] = t('Location Address can not be empty');
        }

        return $error;
    }

    /**
     * @param Posts $post
     * @return Posts
     */
    public function handlingForm($post) {
        $request = Factory::getRequest();

        $error = array();
        $error = $this->verifyForm($error);

        $event_start_date = $request->post('event_start_date');
        $event_end_date = $request->post('event_end_date');
        $event_all_day = $request->post('event_all_day');
        $event_start_time = $request->post('event_start_time');
        $event_end_time = $request->post('event_end_time');

        $event_location_name = $request->post('event_location_name');
        $event_location_address = $request->post('event_location_address');
        $event_location_city = $request->post('event_location_city');

        $event_contact_name = $request->post('event_contact_name');
        $event_contact_address = $request->post('event_contact_address');
        $event_contact_phone = $request->post('event_contact_phone');
        $event_contact_fax = $request->post('event_contact_fax');
        $event_contact_email = $request->post('event_contact_email');

        $event_data = compact('event_all_day','event_location_name', 'event_location_address', 'event_location_city',
                'event_contact_name', 'event_contact_address', 'event_contact_phone',
                'event_contact_fax', 'event_contact_email');

        if (empty($error)) {
            /** processing event date */
            if ($event_all_day) {
//                $event_end_date = ($event_end_date)? $event_end_date : $event_start_date;
                $event_start_date = $event_start_date .' ' .'00:00';
                $event_end_date = $event_start_date .' ' .'24:00';

                $event_start_date = DateTime::createFromFormat('d/m/Y H:i', $event_start_date);
                $event_end_date = DateTime::createFromFormat('d/m/Y H:i', $event_end_date);
            } else {
                $event_start_time = ($event_start_time)? $event_start_time : '00:00';
                $event_end_time = ($event_end_time)? $event_end_time : '00:00';

                $event_start_date = DateTime::createFromFormat('d/m/Y H:i', $event_start_date .' ' .$event_start_time);
                $event_end_date = DateTime::createFromFormat('d/m/Y H:i', $event_end_date .' ' .$event_end_time);
            }

            $eventStartDate = PostProperty::retrieveByPropertyAndPostId('event_start_date', $post->getId());
            $eventStartDate = ($eventStartDate)? $eventStartDate : new PostProperty();
            $eventStartDate->setProperty('event_start_date');
            $eventStartDate->setDatetimeValue($event_start_date);
            $eventStartDate->setValueType(PostProperty::DATETIME);
            $eventStartDate->setPostId($post->getId());
            $eventStartDate->save();

            $eventEndDate = PostProperty::retrieveByPropertyAndPostId('event_end_date', $post->getId());
            $eventEndDate = ($eventEndDate)? $eventEndDate : new PostProperty();
            $eventEndDate->setProperty('event_end_date');
            $eventEndDate->setDatetimeValue($event_end_date);
            $eventEndDate->setValueType(PostProperty::DATETIME);
            $eventEndDate->setPostId($post->getId());
            $eventEndDate->save();

            foreach ($event_data as $key => $value) {
                $pp = PostProperty::retrieveByPropertyAndPostId($key, $post->getId());
                $pp = ($pp)? $pp : new PostProperty();
                $pp->setProperty($key);
                $pp->setTextValue($value);
                $pp->setPostId($post->getId());
                $pp->save();
            }

            $post->setCreatedTime($event_start_date);
            $post->save(false);
        }


        return $post;
    }
}