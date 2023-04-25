<?php


/**
 * AWS webgl module version info
 *
 * @package mod_webgl
 * @copyright  2020 Brain station 23 ltd <>  {@link https://brainstation-23.com/}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

global $OUTPUT;

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once(dirname(__FILE__) . '/lib.php');
require_once(dirname(__FILE__) . '/BlobStorage.php');
$id = optional_param('id', 0, PARAM_INT); // Course_module ID, or.
$n = optional_param('n', 0, PARAM_INT); // Webgl instance ID - it should be named as the first character of the module.

if ($id) {
    $cm = get_coursemodule_from_id('webgl', $id, 0, false, MUST_EXIST);
    $course = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
    $webgl = $DB->get_record('webgl', array('id' => $cm->instance), '*', MUST_EXIST);
} else if ($n) {
    $webgl = $DB->get_record('webgl', array('id' => $n), '*', MUST_EXIST);
    $course = $DB->get_record('course', array('id' => $webgl->course), '*', MUST_EXIST);
    $cm = get_coursemodule_from_instance('webgl', $webgl->id, $course->id, false, MUST_EXIST);
} else {
    throw new Exception('Вы обязаны указать ID модуля курса или ID экземпляра активности webgl');
}

require_login($course, true, $cm);

$event = \mod_webgl\event\course_module_viewed::create(array(
    'objectid' => $PAGE->cm->instance,
    'context' => $PAGE->context,
));
$event->add_record_snapshot('course', $PAGE->course);
$event->add_record_snapshot($PAGE->cm->modname, $webgl);
$event->trigger();

// Печать заголовка страницы

$PAGE->set_url('/mod/webgl/view.php', array('id' => $cm->id));
$PAGE->set_title(format_string($webgl->name));
$PAGE->set_heading(format_string($course->fullname));
$PAGE->set_cacheable(false);
$PAGE->set_pagelayout('embedded');
$context = context_course::instance($course->id);


//$fa = $PAGE->get_renderer('mod_lesson');
//echo $fa->header($webgl,$cm);
echo $OUTPUT->header();

$array = [];
$array['sitename'] = 'URFU';

echo  $OUTPUT -> render_from_template ( 'theme_boost/navbar' ,  $array);

echo GetFrameGame($webgl);

echo $OUTPUT->footer();
