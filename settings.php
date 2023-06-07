<?php

/**
 * WebGL plugin settings.
 *
 * @package mod_webgl
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {

    $storage_engines = [1 => get_string('local_file_system','mod_webgl')];

    $settings->add(new admin_setting_configselect('webgl/storage_engine',
        get_string('storage_engine', 'mod_webgl'),
        get_string('storage_engine_help', 'mod_webgl'), '1', $storage_engines));

    $settings->add(new admin_setting_configtext('webgl/iframe_height',
        get_string('iframe_height', 'mod_webgl'),
        get_string('iframe_height_help', 'mod_webgl'), '600px', PARAM_TEXT, 10));

    $settings->add(new admin_setting_configtext('webgl/iframe_width',
        get_string('iframe_width', 'mod_webgl'),
        get_string('iframe_width_help', 'mod_webgl'), '100%', PARAM_TEXT, 10));

}
