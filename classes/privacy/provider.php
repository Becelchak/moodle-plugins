<?php
/**
 * WebGL plugin privacy api implementation.
 *
 * @package mod_webgl
 */

namespace mod_webgl\privacy;
defined('MOODLE_INTERNAL') || die();

/**
 * Privacy Subsystem class for mod_webgl implementing null_provider.
 *
 * @package mod_webgl
 */

class provider implements
    // This plugin does not store any personal user data.
    \core_privacy\local\metadata\null_provider {

    /**
     * Get the language string identifier with the component's language
     * file to explain why this plugin stores no data.
     *
     * @return  string
     */
    public static function get_reason(): string {
        return 'privacy:metadata';
    }
}
