<?php
/**
 * Defines the view event.
 *
 * @package mod_webgl
 * @copyright  2020 Brain station 23 ltd <>  {@link https://brainstation-23.com/}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
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
