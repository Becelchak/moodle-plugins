<?php

/**
 * AWS webgl module version info
 *
 * @package mod_webgl
 */

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');

require_once($CFG->libdir . '/setuplib.php');

require_once(dirname(__FILE__) . '/lib.php');


$id = optional_param('id', 0, PARAM_INT); // Course_module ID, or
$n = optional_param('n', 0, PARAM_INT); // webgl instance ID - it should be named as the first character of the module.

if ($id) {
    $cm = get_coursemodule_from_id('webgl', $id, 0, false, MUST_EXIST);
    $course = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
    $webgl = $DB->get_record('webgl', array('id' => $cm->instance), '*', MUST_EXIST);
} else if ($n) {
    $webgl = $DB->get_record('webgl', array('id' => $n), '*', MUST_EXIST);
    $course = $DB->get_record('course', array('id' => $webgl->course), '*', MUST_EXIST);
    $cm = get_coursemodule_from_instance('webgl', $webgl->id, $course->id, false, MUST_EXIST);
} else {
    throw new Exception(get_string('download_exception', 'webgl'));
}

require_login($course, true, $cm);
