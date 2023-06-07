<?php

/**
 * Locallib.
 *
 * @package mod_webgl
 */

defined('MOODLE_INTERNAL') || die;

require_once('mod_form.php');

/** Returns a line of html code for render the game player
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
        // File not found due to incorrect directory
        throw new moodle_exception('invalidcontent', 'mod_webgl');
    }

    $indexfile = $dirname . 'index.html';

    if (!in_array($indexfile, $filelist)) {
        // File not found due to incorrect index.html
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
 * Upload zip file.
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
