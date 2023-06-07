<?php

/**
 * webgl module language file
 *
 * @package mod_webgl
 */

$string['modulename'] = 'WebGL';
$string['modulenameplural'] = 'WebGL';
$string['modulename_help'] = 'WebGL is a JavaScript API for rendering interactive 2D and 3D graphics within any compatible web browser without the use of plug-ins. WebGL is fully integrated with other web standards, allowing GPU-accelerated usage of physics and image processing and effects as part of the web page canvas.';
$string['contentheader'] = 'Content';
$string['input:file'] = 'WebGL file';
$string['header:content'] = 'WebGL content';
$string['webgl:addinstance'] = 'Add a new WebGL Application.';
$string['webgl:submit'] = 'Submit WebGL Application';
$string['webgl:view'] = 'View webGL';
$string['nowebgls'] = 'No webgl records found in this course.';
$string['appstreamfieldset'] = 'Custom example fieldset';
$string['appstreamname'] = 'WebGL name';
$string['appstreamname_help'] = 'This is the content of the help tooltip associated with the appstreamname field. Markdown syntax is supported.';
$string['webgl'] = 'webgl';
$string['pluginadministration'] = 'webgl administration';
$string['pluginname'] = 'webgl';
$string['ziparchive'] = 'Select a zip file.';
$string['ziparchive_help'] = 'Select a zip file containing index.html, index.liquid, logo, .htaccess and build files and folders.';

$string['content_advcheckbox'] = 'Update WebGL content too';
$string['content_advcheckbox_help'] = 'If enabled,you can also update the WebGL content';

$string['download_exception'] = 'You must specify a course_module ID or an instance ID';

// BEGIN: Fields in the admin form.

$string['storage_engine'] = 'Storage Engine';
$string['storage_engine_help'] = 'Storage Engine: Webgl provide only Moodle default file system.';

$string['store_zip_file'] = 'Upload zip file';
$string['store_zip_file_help'] = 'Also upload Uploaded zip file to Azure Blob storage.';

$string['iframe_height'] = 'Content Height';
$string['iframe_height_help'] = 'Height of the Iframe that load WebGL content in (pixels, (r)em, percentages). Default Value is 550px.';

$string['iframe_width'] = 'Content Width';
$string['iframe_width_help'] = 'Width of the Iframe that load WebGL content in (pixels, (r)em, percentages). Default Value is 100%.';
$moduleintro = get_string('moduleintro');

$string['before_description'] = 'Show WebGL content before ' . $moduleintro . ' section.';
$string['before_description_help'] = 'By default WebGL content will show after ' . $moduleintro . ' section. Check the checkbox If you want to show content before ' . $moduleintro . ' section ';

$string['storage'] = 'Storage details';
$string['local_file_system'] = 'Moodle file system';

$string['privacy:metadata'] = 'The mod_webgl plugin does not store any personal data.';
$string['previously_uploaded'] = 'Previously Uploaded file name :';

// END: Fields in the admin form.
