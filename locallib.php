<?php

/**
 * Locallib.
 *
 * @package mod_webgl
 * @copyright  2020 Brain station 23 ltd <>  {@link https://brainstation-23.com/}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

require_once('mod_form.php');

/** Возвращает строку html кода, позволяя отрисовать плеер с юнити игрой
 * @param $webgl
 * @return string
 */
function GetFrameGame ($webgl) {
    return
        '<div class="webgl-iframe-content-loader">
    <iframe
    width="100%"
    height="100%"
    src="' . $webgl->index_file_url . '" >
    </iframe>
</div>
';
}

/**
 * Extracts the imported zip contents.
 * Push to Azure BLOB storage.
 * @param stdClass $webgl
 * @param string $zipfilepath
 * @return array List of imported files.
 * @throws moodle_exception
 */
function webgl_import_extract_upload_contents(stdClass $webgl, string $zipfilepath): array {

    $importtempdir = make_request_directory('webglcontentimport' . microtime(false));

    $zip = new zip_packer();

    $filelist = $zip->extract_to_pathname($zipfilepath, $importtempdir);

    $dirname = array_key_first($filelist);

    if ($dirname == 'index.html') {
        $dirname = '';

    }

    if (!is_dir($importtempdir . DIRECTORY_SEPARATOR . $dirname)) {

        $dirnamearr = explode('/', $dirname);

        $dirname = $dirnamearr[0] . DIRECTORY_SEPARATOR;

    }

    if (!is_dir($importtempdir . DIRECTORY_SEPARATOR . $dirname)) {
        // Файл не найден из-за некорректной директории
        throw new moodle_exception('invalidcontent', 'mod_webgl');
    }

    $indexfile = $dirname . 'index.html';

    if (!in_array($indexfile, $filelist)) {
        // Файл не найден из-за некорректного index.html
        throw new moodle_exception('errorimport', 'mod_webgl');
    }

    $webgl->storage_engine = mod_webgl_mod_form::STORAGE_ENGINE_LOCAL_DISK;

    $context = context_module::instance($webgl->coursemodule);
    $zip = new zip_packer();
    $extractedfiles = $zip->extract_to_storage($zipfilepath,$context->id,'mod_webgl','content', $webgl->id,'/');
    if (!$extractedfiles){
        throw new moodle_exception('invalidcontent','mod_webgl');
    }
    $moodle_url = moodle_url::make_pluginfile_url($context->id,'mod_webgl','content',$webgl->id,'/'.$dirname,'index.html');
    return [
        'index' => $moodle_url->out()
    ];
}


/**
 * Загрузка zip файла.
 *
 * @param stdClass $webgl
 * @param moodleform_mod $mform
 * @param string $elname
 * @param string $res
 * @throws dml_exception
 */
function webgl_upload_zip_file($webgl, $mform, $elname, $res) {
    if ($webgl->store_zip_file) {

        if ($webgl->storage_engine == mod_webgl_mod_form::STORAGE_ENGINE_AZURE) {

            $zipcontent = $mform->get_file_content($elname);

            webgl_import_zip_contents($webgl, $zipcontent);

        } elseif ($webgl->storage_engine == mod_webgl_mod_form::STORAGE_ENGINE_S3) {
            list($s3, $endpoint) = webgl_get_s3_instance($webgl);

            $bucket = get_config('webgl', 'bucket_name');
            $filename = $webgl->webgl_file;
            $foldername = webgl_cloud_storage_webgl_content_prefix($webgl);
            $s3->putObject($s3->inputFile($res), $bucket, $foldername . '/' . $filename, S3::ACL_PUBLIC_READ, [
                'Content-Type' => "application/octet-stream",
            ]);

        }else{
            //TODO: Implement Moodle file system zip file import
        }
    }
}

/**
 * Delete from File System API.
 *
 * @param stdClass $webgl
 * @return void
 * @throws coding_exception
 * @throws moodle_exception
 */
function webgl_delete_from_file_system(stdClass $webgl): void
{
    $context = context_module::instance($webgl->coursemodule);
    // Get file
    $fs = get_file_storage();
    $files = $fs->get_area_files($context->id, 'mod_webgl', 'content', $webgl->id, 'id ASC');
    foreach ($files as $file) {
        $file->delete();
    }
}

/**
 * Index file url.
 *
 * @param stdClass $webgl
 * @param array $blobdatadetails
 * @return stdClass
 */
function webgl_index_file_url($webgl, $blobdatadetails)
{
    if ($webgl->storage_engine == mod_webgl_mod_form::STORAGE_ENGINE_S3) {
        $webgl->index_file_url = $blobdatadetails['index'];
    } elseif ($webgl->storage_engine == mod_webgl_mod_form::STORAGE_ENGINE_LOCAL_DISK) {
        $webgl->index_file_url = $blobdatadetails['index'];
    } else {
        $webgl->index_file_url = $blobdatadetails[$blobdatadetails[BS_WEBGL_INDEX]];
    }
    return $webgl;
}

//class webgl extends webgl_base {
//    public function __construct($properties, $cm = null, $course = null) {
//        parent::__construct($properties);
//        $this->cm = $cm;
//        $this->courserecord = $course;
//    }
//}

/**
 * Activity navigation (нижняя). Неактуально.
 *
 * @param moodle_page $PAGE
 * @return string
 * @throws coding_exception
 * @throws moodle_exception
 */
//function activity_navigation($PAGE) {
//    global $CFG;
//    // First we should check if we want to add navigation.
//    $context = $PAGE->context;
//
//    // Get a list of all the activities in the course.
//    $course = $PAGE->cm->get_course();
//    $modules = get_fast_modinfo($course->id)->get_cms();
//
//    $section = 1;
//
//    // Put the modules into an array in order by the position they are shown in the course.
//    $mods = [];
//    $activitylist = [];
//    foreach ($modules as $module) {
//        // Only add activities the user can access, aren't in stealth mode and have a url (eg. mod_label does not).
//        if (!$module->uservisible || $module->is_stealth() || empty($module->url)) {
//            continue;
//        }
//        $mods[$module->id] = $module;
//
//        // No need to add the current module to the list for the activity dropdown menu.
//        if ($module->id == $PAGE->cm->id) {
//
//            $curentmodsection = $module->get_section_info();
//            $section = $curentmodsection;
//            continue;
//        }
//        // Module name.
//        $modname = $module->get_formatted_name();
//        // Display the hidden text if necessary.
//        if (!$module->visible) {
//            $modname .= ' ' . get_string('hiddenwithbrackets');
//        }
//        // Module URL.
//        $linkurlnext = new moodle_url($module->url, array('forceview' => 1));
//        // Add module URL (as key) and name (as value) to the activity list array.
//        $activitylist[$linkurlnext->out(false)] = $modname;
//    }
//
//    $nummods = count($mods);
//
//    // If there is only one mod then do nothing.
//    if ($nummods == 1) {
//        return '';
//    }
//
//    // Get an array of just the course module ids used to get the cmid value based on their position in the course.
//    $modids = array_keys($mods);
//
//    // Get the position in the array of the course module we are viewing.
//    $position = array_search($PAGE->cm->id, $modids);
//    $sectionurl = new moodle_url('/course/view.php', ['id' => $course->id, 'section' => $section->section]);
//
//    $prevmod = null;
//    $nextmod = null;
//    $prevtotalurl = null;
//    $nexttotalurl = null;
//
//    // Check if we have a previous mod to show.
//    if ($position > 0) {
//        $prevmod = $mods[$modids[$position - 1]];
//        $linkurlprev = new \moodle_url($prevmod->url, array('forceview' => 1));
//        $linknameprev = $prevmod->get_formatted_name();
//        if (!$prevmod->visible) {
//            $linknameprev .= ' ' . get_string('hiddenwithbrackets');
//        }
//        $prevtotalurl = '<a href="' . $linkurlprev
//            . '" id="prev-activity-link" class="btn btn-link btn-action text-truncate" title="'
//            . $linknameprev . '">' . $linknameprev . '</a>';
//    }
//
//    // Check if we have a next mod to show.
//    if ($position < ($nummods - 1)) {
//        $nextmod = $mods[$modids[$position + 1]];
//        $linkurlnext = new \moodle_url($nextmod->url, array('forceview' => 1));
//        $linknamenext = $nextmod->get_formatted_name();
//        if (!$nextmod->visible) {
//            $linknamenext .= ' ' . get_string('hiddenwithbrackets');
//        }
//        $nexttotalurl = '<a href="' . $linkurlnext
//            . '" id="next-activity-link" class="btn btn-link btn-action text-truncate" title="'
//            . $linknamenext . '"> ' . $linknamenext . '</a>';
//    }
//    $sectioname = $section->name ?? get_string('sectionname', 'format_' . $course->format) . ' ' . $section->section;
//    $sectioninfourl = $section->section > 0 ? '<a href="' . $sectionurl
//        . '"   id="activity-link" class="btn btn-link btn-action text-truncate" title="'
//        . $sectioname . '">' . $sectioname . '</a>' : '';
//
//    return '<div class="course-footer-nav">
//            <hr class="hr">
//            <div class="row">
//                <div class="col-sm-12 col-md">
//                    <div class="pull-left">' . $prevtotalurl . '</div>
//                </div>
//                <div class="col-sm-12 col-md-2">
//                    <div class="mdl-align" >' . $sectioninfourl . '</div>
//                </div>
//                <div class="col-sm-12 col-md">
//                    <div class="pull-right">' . $nexttotalurl . '</div>
//                </div>
//            </div>
//        </div>';
//}
// }
