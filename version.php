<?php
/**
 * WebGL plugin version info
 *
 * @package mod_webgl
 */

defined('MOODLE_INTERNAL') || die();

$plugin->version = 2021100701; // The current version (Date: YYYYMMDDXX).

$plugin->requires = 2019111806; // Requires this Moodle version.

$plugin->component = 'mod_webgl'; // Full name of the plugin (used for diagnostics).

$plugin->dependencies = [
    'repository_s3' => 2019111800,
];

$plugin->release = 'v-1.0.2';

$plugin->maturity = MATURITY_STABLE;
