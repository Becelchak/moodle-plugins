<?php
/**
 * Defines the view event.
 *
 * @package mod_webgl
 */

namespace mod_webgl\event;

defined('MOODLE_INTERNAL') || die();
class course_module_viewed extends \core\event\course_module_viewed {
    /**
     * Initialize the event
     */
    protected function init() {
        $this->data['objecttable'] = 'webgl';
        parent::init();
    }
}
