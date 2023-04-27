<?php


/**
 * Шаги для резервного копирования
 */

class backup_webgl_activity_structure_step extends backup_activity_structure_step {

    protected function define_structure() {

        // The lesson table
        // This table contains all of the goodness for the webgl module, quite
        // alot goes into it but nothing relational other than course when will
        // need to be corrected upon restore.
        $webgl = new backup_nested_element('webgl', array('id'), array(
            'course', 'name', 'intro', 'introformat', 'webgl_file', 'storage_engine',
            'usepassword', 'password',
            'account_name', 'account_key', 'container_name', 'access_key', 'secret_key', 'endpoint',
            'bucket_name', 'store_zip_file', 'iframe_height', 'iframe_width', 'before_description',
            'timecreated', 'timemodified', 'grade'
        ));

        // Set the source table for the elements that aren't reliant on the user
        // at this point (lesson, lesson_pages, lesson_answers)
        $webgl->set_source_table('webgl', array('id' => backup::VAR_ACTIVITYID));


        // Annotate the file areas in user by the lesson module.
        $webgl->annotate_files('mod_webgl', 'intro', null);
        $webgl->annotate_files('mod_webgl', 'webgl_file', null);

        // Prepare and return the structure we have just created for the lesson module.
        return $this->prepare_activity_structure($webgl);
    }
}