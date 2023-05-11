<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * WebGL plugin settings.
 *
 * @package mod_webgl
 * @copyright  2020 Brain station 23 ltd <>  {@link https://brainstation-23.com/}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
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
