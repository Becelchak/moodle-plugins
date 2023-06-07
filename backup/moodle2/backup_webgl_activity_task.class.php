<?php

/**
 * This file contains the backup task for the lesson module
 *
 * @package     mod_lesson
 * @category    backup
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/mod/webgl/backup/moodle2/backup_webgl_stepslib.php');

/**
 * Provides the steps to perform one complete backup of the Lesson instance
 *
 */
class backup_webgl_activity_task extends backup_activity_task {

    /**
     * No specific settings for this activity
     */
    protected function define_my_settings() {
    }

    /**
     * Defines a backup step to store the instance data in the webgl.xml file
     */
    protected function define_my_steps() {
        $this->add_step(new backup_webgl_activity_structure_step('webgl structure', 'webgl.xml'));
    }

    /**
     * Encodes URLs to various Webgl scripts
     *
     * @param string $content some HTML text that eventually contains URLs to the activity instance scripts
     * @return string the content with the URLs encoded
     */
    static public function encode_content_links($content) {
        global $CFG;

        $base = preg_quote($CFG->wwwroot.'/mod/webgl','#');

        // Provides the interface for overall authoring of webgl frames
        $pattern = '#'.$base.'/edit\.php\?id=([0-9]+)#';
        $replacement = '$@WEBGLEDIT*$1@$';
        $content = preg_replace($pattern, $replacement, $content);

        // Action for adding a question page.  Prints an HTML form.
        $pattern = '#'.$base.'/editpage\.php\?id=([0-9]+)&(amp;)?pageid=([0-9]+)#';
        $replacement = '$@WEBGLEDIT*$1*$3@$';
        $content = preg_replace($pattern, $replacement, $content);

        // Provides the interface for grading essay questions
        $pattern = '#'.$base.'/essay\.php\?id=([0-9]+)#';
        $replacement = '$@WEBGLEDIT*$1@$';
        $content = preg_replace($pattern, $replacement, $content);

        // Provides the interface for viewing the report
        $pattern = '#'.$base.'/report\.php\?id=([0-9]+)#';
        $replacement = '$@WEBGLEDIT*$1@$';
        $content = preg_replace($pattern, $replacement, $content);

        // This file plays the mediafile set in webgl settings.
        $pattern = '#'.$base.'/mediafile\.php\?id=([0-9]+)#';
        $replacement = '$@WEBGLEDIT*$1@$';
        $content = preg_replace($pattern, $replacement, $content);

        // This page lists all the instances of webgl in a particular course
        $pattern = '#'.$base.'/index\.php\?id=([0-9]+)#';
        $replacement = '$@WEBGLEDIT*$1@$';
        $content = preg_replace($pattern, $replacement, $content);

        // This page prints a particular page of webgl
        $pattern = '#'.$base.'/view\.php\?id=([0-9]+)&(amp;)?pageid=([0-9]+)#';
        $replacement = '$@WEBGLEDIT*$1*$3@$';
        $content = preg_replace($pattern, $replacement, $content);

        // Link to one lesson by cmid
        $pattern = '#'.$base.'/view\.php\?id=([0-9]+)#';
        $replacement = '$@WEBGLEDIT*$1@$';
        $content = preg_replace($pattern, $replacement, $content);

        // Return the now encoded content
        return $content;
    }
}
