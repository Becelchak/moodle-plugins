<?php


defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/course/moodleform_mod.php');

/**
 * webgl activity form
 *
 * @package mod_webgl
 */
class mod_webgl_mod_form extends moodleform_mod {
    /**
     * Storage engine azure.
     */
    const STORAGE_ENGINE_AZURE = 1;

    /**
     * Storage engine s3.
     */
    const STORAGE_ENGINE_S3 = 2;

    /**
     * Storage engine local disk.
     */
    const STORAGE_ENGINE_LOCAL_DISK = 3;

    /**
     * Definition function of the class.
     *
     * return void
     */
    public function definition() {
        global $CFG, $DB;
        $mform = $this->_form;

        // Adding the "general" fieldset, where all the common settings are showed.
        $mform->addElement('header', 'general', get_string('general', 'form'));
        $mform->addElement('text', 'name', get_string('name'), array('size' => '64'));
        if (!empty($CFG->formatstringstriptags)) {
            $mform->setType('name', PARAM_TEXT);
        } else {
            $mform->setType('name', PARAM_CLEANHTML);
        }
        $mform->addRule('name', null, 'required', null, 'client');
        $mform->addRule('name', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');

        // Adding the standard "intro" and "introformat" fields.
        if ($CFG->branch >= 29) {
            $this->standard_intro_elements();
        } else {
            $this->add_intro_editor();
        }

        // WebGl contetn form portion goes here.
        $mform->addElement('header', 'webglcontent', get_string('header:content', 'webgl'));

        $isupdateform = $this->optional_param('update', 0, PARAM_INT);

        if ($isupdateform > 0) {
            $dataforform = $DB->get_record('course_modules', array('id' => $isupdateform));
            $moduledata = $DB->get_record('webgl', array('id' => $dataforform->instance));
            if ($moduledata->store_zip_file) {
                $filename = str_replace('index.html', $moduledata->webgl_file, $moduledata->index_file_url);
                $ancor = '<div id="fitem_id_webgl_file" class="form-group row  fitem">
                        <div class="col-md-3">
                            <label class="col-form-label d-inline " for="id_webgl_file">&nbsp;</label>
                        </div>
                        <div class="col-md-9 form-inline felement" data-fieldtype="text" id="id_webgl_file">
                            <a target="_blank" href="' . $filename . '">Download ' . $moduledata->webgl_file . '</a>
                        </div>
                    </div>';
            } else {
                $prev = get_string('previously_uploaded', 'mod_webgl');
                $ancor = '<div id="fitem_id_webgl_file" class="form-group row  fitem">
                        <div class="col-md-3">
                            <label class="col-form-label d-inline " for="id_webgl_file">&nbsp;</label>
                        </div>
                        <div class="col-md-9 form-inline felement" data-fieldtype="text" id="id_webgl_file">
                            <p> '.$prev.' ' . $moduledata->webgl_file . '</p>
                        </div>
                    </div>';
            }
            $mform->addElement('html', $ancor);

        }

        $mform->addElement('filepicker', 'importfile', get_string('input:file', 'webgl'), null, ['accepted_types' => '.zip']);
        $mform->addHelpButton('importfile', 'ziparchive', 'webgl');

        if ($isupdateform > 0) {
            $mform->addElement('advcheckbox', 'update_webgl_content', get_string('content_advcheckbox', 'webgl'));
            $mform->addHelpButton('update_webgl_content', 'content_advcheckbox', 'webgl');
            $mform->disabledIf('importfile', 'update_webgl_content');
        } else {
            $mform->addRule('importfile', null, 'required');
        }

        $mform->addElement('text', 'iframe_height', get_string('iframe_height', 'webgl'));
        $mform->setType('iframe_height', PARAM_TEXT);
        $mform->addHelpButton('iframe_height', 'iframe_height', 'webgl');
        $mform->addRule('iframe_height', null, 'required', null, 'client');
        $iframeheight = get_config('webgl', 'iframe_height');
        $mform->setDefault('iframe_height', $iframeheight);

        $mform->addElement('text', 'iframe_width', get_string('iframe_width', 'webgl'));
        $mform->setType('iframe_width', PARAM_TEXT);
        $mform->addHelpButton('iframe_width', 'iframe_width', 'webgl');
        $mform->addRule('iframe_width', null, 'required', null, 'client');
        $iframewidth = get_config('webgl', 'iframe_width');
        $mform->setDefault('iframe_width', $iframewidth);

        $mform->addElement('advcheckbox', 'before_description', get_string('before_description', 'webgl'));
        $mform->addHelpButton('before_description', 'before_description', 'webgl');
        $mform->addRule('before_description', null, 'required', null, 'client');

        // Storage form fields goes here.
        $mform->addElement('header', 'storage', get_string('storage', 'webgl'));

        $mform->addElement('select', 'storage_engine', get_string('storage_engine', 'webgl'),
            [
                1 => get_string('local_file_system','mod_webgl')
            ]);
        $mform->addHelpButton('storage_engine', 'storage_engine', 'webgl');
        $mform->addRule('storage_engine', null, 'required', null, 'client');
        $storageengine = get_config('webgl', 'storage_engine');
        $mform->setDefault('storage_engine', $storageengine);

        $mform->addElement('advcheckbox', 'store_zip_file', get_string('store_zip_file', 'webgl'));
        $mform->addHelpButton('store_zip_file', 'store_zip_file', 'webgl');
        $storezipfile = get_config('webgl', 'store_zip_file');
        $mform->setDefault('store_zip_file', $storezipfile);
        $mform->hideIf('store_zip_file', 'storage_engine', 'eq', '3');
        $mform->disabledIf('store_zip_file', 'storage_engine', 'eq', '3');

        $this->standard_grading_coursemodule_elements();

        // Add standard elements, common to all modules.
        $this->standard_coursemodule_elements();

        // Add standard buttons, common to all modules.
        $this->add_action_buttons();
    }

}
