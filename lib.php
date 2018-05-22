<?php
// This file is part of Ephorus - http://ephorus.com/
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
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * lib.php - Contains Ephorus specific functions called by Modules.
 *
 * @since 2.4
 * @package    plagiarism_ephorus
 * @subpackage plagiarism
 * @author     Guido Bonnet
 * @copyright  2012 onwards Ephorus  {@link http://ephorus.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.'); // It must be included from a Moodle page.
}

// Get global class.
global $CFG;
require_once($CFG->dirroot.'/plagiarism/lib.php');
require_once($CFG->dirroot.'/plagiarism/ephorus/include/class.DLEApi.php');

class plagiarism_plugin_ephorus extends plagiarism_plugin {
    /**
     * hook to allow plagiarism specific information to be displayed beside a submission
     *
     * @param array  $linkarray contains all relevant information for the plugin to generate a link
     * @return string
     */
    public function get_links($linkarray) {
        global $CFG, $DB;

        $action = optional_param('action', '', PARAM_ACTION);
        $accepted_actions = array('grading', 'submitgrade', 'viewpluginassignsubmission');

        $sql = 'SELECT ea.id FROM {plagiarism_eph_assignment} ea
                LEFT JOIN {course_modules} cm ON cm.instance = ea.assignment
                WHERE cm.id = ?';

        $file_component = isset($linkarray['file']) ? $DB->get_field('files', 'component', array('id' => $linkarray['file']->get_id())) : false;

        if (!in_array($action, $accepted_actions) || //
            !$DB->record_exists_sql($sql, array($linkarray['cmid'])) || //
            !isset($linkarray['file']) || //
            $file_component !== 'assignsubmission_file') {
            return '';
        }

        $return = '<p>'.get_string('ephorus_status', 'plagiarism_ephorus').': ';
        $file = $linkarray['file'];
        $results = $this->get_file_results($linkarray['cmid'], $linkarray['userid'], $file);

        if (!$results) {
            return '<a href="'.$CFG->wwwroot.'/plagiarism/ephorus/functions.php?action=send_to_ephorus&file_id='
                .$file->get_id().'" class="send-to-eph" rel="'.$file->get_id().'">
                    <img src="'.$CFG->wwwroot.'/plagiarism/ephorus/img/ephorus.gif"
                        alt="'.get_string('send_document_manually', 'plagiarism_ephorus').'"></a>'."\n";
        }

        if ($results['processtype'] == 2) {
            $return .= get_string('reference', 'plagiarism_ephorus')."\n";
        } else {
            switch ($results['status']) {
                case -1:
                    $return .= '<span title="'.get_string('unfinalized_file', 'plagiarism_ephorus').'">'
                        .get_string('unfinalized_file', 'plagiarism_ephorus').'</span>'."\n";
                    break;
                case 0:
                    $return .= (!$results['guid'] || $results['guid'] == '')?
                        '<span title="'.get_string('wait_for_sending_msg', 'plagiarism_ephorus').'">'
                            .get_string('wait_for_sending', 'plagiarism_ephorus').'</span>'."\n":
                        '<span title="'.get_string('processing_msg', 'plagiarism_ephorus').'">'
                            .get_string('processing', 'plagiarism_ephorus').'</span>'."\n";
                    break;
                case 1:
                    $return .= '<a href="'.$results['reporturl'].'" target="_blank">'.$results['score'].'%</a>'."\n";
                    $return .= '<a href="'.$CFG->wwwroot.'/plagiarism/ephorus/functions.php?action=change_index&document_guid='
                        .$results['guid'].'" class="change-visibility" rel="'.$results['guid'].'">
                            <img src="'.$CFG->wwwroot.'/pix/i/'.(($results['visible'] == 1) ? 'hide' : 'show' ).'.png" alt="">
                        </a>'."\n";
                    break;
                case 2:
                    $return .= '<a href="'.$results['reporturl'].'" target="_blank" title="'
                        .get_string('duplicate_document_msg', 'plagiarism_ephorus').'">'
                        .get_string('duplicate_document', 'plagiarism_ephorus').
                        '</a>'."\n";
                    break;
                case 3:
                    $return .= '<span title="'.get_string('document_protected_msg', 'plagiarism_ephorus').'">'
                        .get_string('document_protected', 'plagiarism_ephorus').'</span>'."\n";
                    break;
                case 4:
                    $return .= '<span title="'.get_string('not_enough_text_msg', 'plagiarism_ephorus').'">'
                        .get_string('not_enough_text', 'plagiarism_ephorus').'</span>'."\n";
                    break;
                case 5:
                    $return .= '<span title="'.get_string('no_text_msg', 'plagiarism_ephorus').'">'
                        .get_string('no_text', 'plagiarism_ephorus').'</span>'."\n";
                    break;
                case 6:
                    $return .= '<span title="'.get_string('unknown_error_msg', 'plagiarism_ephorus').'">'
                        .get_string('unknown_error', 'plagiarism_ephorus').'</span>'."\n";
                    break;
                case 99:
                    $results['error'] = empty($results['error']) ? 'unknown_file_error' : $results['error'];
                    $return .= '<span title="'.get_string($results['error'].'_msg', 'plagiarism_ephorus').'">'
                        .get_string($results['error'], 'plagiarism_ephorus').'</span>'."\n";
                    break;
            }
        }
        $return .= '</p>';
        return $return;
    }
    /**
     * hook to allow plagiarism specific information to be returned unformatted
     *
     * @param int $cmid
     * @param int $userid
     * @param $file file object
     * @return array containing at least:
     *   - 'analyzed' - whether the file has been successfully analyzed
     *   - 'score' - similarity score - ('' if not known)
     *   - 'reporturl' - url of originality report - '' if unavailable
     */
    public function get_file_results($cmid, $userid, $file) {
        global $DB, $CFG;

        $results = false;

        $sql = 'SELECT ed.id, ed.guid, ed.percentage, ed.status, ed.error, ed.visible, ed.processtype
                FROM {plagiarism_eph_document} ed
                WHERE ed.fileid = ? AND ed.processtype > 0';

        if ($document = $DB->get_record_sql($sql, array($file->get_id()))) {
            if ($DB->get_field('assign_submission', 'status', array('id' => $file->get_itemid())) == 'submitted') {
                $record = new stdClass();
                $record->id = $document->id;
                $record->status = ($document->status == -1) ? 0 : $document->status;
                $DB->update_record('plagiarism_eph_document', $record);
            }

            $results = array(
                'analyzed' => (bool) $document->status,
                'score' => $document->percentage,
                'reporturl' => ($document->guid) ? $CFG->wwwroot.'/plagiarism/ephorus/report.php?guid='.$document->guid : '',
                'guid' => ($document->guid) ? $document->guid : '',
                'status' => $document->status,
                'error' => $document->error,
                'visible' => $document->visible,
                'processtype' => $document->processtype,
            );
        }
        return $results;
    }
    /**
     * hook to add plagiarism specific settings to a module settings page
     *
     * @param object $mform  - Moodle form
     * @param object $context - current context
     * @param string $modulename - Name of the module
     * @return object containing form items
     */
    public function get_form_elements_module($mform, $context, $modulename = '') {
        global $DB;

        if($modulename != 'mod_assign') {
            return;
        }

        $processtypes = array(
            1 => get_string('default', 'plagiarism_ephorus'),
            2 => get_string('reference', 'plagiarism_ephorus'),
            3 => get_string('private', 'plagiarism_ephorus')
        );

        $mform->addElement('header', 'ephorus', get_string('pluginname', 'plagiarism_ephorus'));
        $mform->addElement('checkbox', 'ephorus_use', get_string('use_ephorus', 'plagiarism_ephorus'));
        $mform->addElement('select', 'processtype', get_string('processtype', 'plagiarism_ephorus'), $processtypes);
        $mform->addHelpButton('processtype', 'processtype', 'plagiarism_ephorus');

        $cmid = optional_param('update', 0, PARAM_INT);
        $sql = 'SELECT ea.processtype
                FROM {course_modules} cm
                LEFT JOIN {plagiarism_eph_assignment} ea ON ea.assignment = cm.instance
                WHERE cm.id = ?';
        if (($processtype = $DB->get_field_sql($sql, array($cmid))) || (!$cmid)) {
            $processtype = ($processtype) ? $processtype : get_config('plagiarism_ephorus')->processtype;
            $mform->setDefault('ephorus_use', 'checked');
            $mform->setDefault('processtype', $processtype);
        } else {
            $mform->setDefault('ephorus_use', null);
            $mform->setDefault('processtype', get_config('plagiarism_ephorus')->processtype);
        }
    }
    /**
     * hook to save plagiarism specific settings on a module settings page
     *
     * @param object $data - data from an mform submission.
     */
    public function save_form_elements($data) {
        global $DB;

        $ephorus_assignment = $DB->get_field('plagiarism_eph_assignment', 'id', array('assignment'=>$data->instance));
        if (isset($data->ephorus_use)) {
            $record = new stdClass();
            $record->assignment = $data->instance;
            $record->processtype = $data->processtype;
            if ($ephorus_assignment) {
                $record->id = $ephorus_assignment;
                $DB->update_record('plagiarism_eph_assignment', $record);
            } else {
                $DB->insert_record('plagiarism_eph_assignment', $record);
            }
        } else {
            if ($ephorus_assignment) {
                $DB->delete_records('plagiarism_eph_assignment', array('id' => $ephorus_assignment));
            }
        }
    }
    /**
     * hook to allow a disclosure to be printed notifying users what will happen with their submission
     *
     * @param int $cmid - course module id
     * @return string
     */
    public function print_disclosure($cmid) {
        global  $DB, $OUTPUT;

        $return = '';

        $sql = "SELECT ea.id FROM {plagiarism_eph_assignment} ea
                LEFT JOIN {course_modules} cm ON cm.instance = ea.assignment
                LEFT JOIN {modules} m ON m.id = cm.module
                WHERE m.name = 'assign' AND cm.id = ?";

        if ($DB->record_exists_sql($sql, array($cmid))) {
            $formatoptions = new stdClass();
            $formatoptions->noclean = true;

            $return .= $OUTPUT->box_start('generalbox boxaligncenter', 'intro');
            $return .= format_text(get_config('plagiarism_ephorus')->student_disclosure, FORMAT_MOODLE, $formatoptions);
            $return .= $OUTPUT->box_end();
        }

        return $return;
    }
    /**
     * hook to allow status of submitted files to be updated - called on grading/report pages.
     *
     * @param object $course - full Course object
     * @param object $cm - full cm object
     */
    public function update_status($course, $cm) {
    }
    /**
     * hook for cron
     *
     */
    public function cron() {
        global $CFG, $DB;

        if(get_config('plagiarism_ephorus')->use_cron) {
            // Check to see if all ephorus documents exist
            $sql = "SELECT ed.id, ed.guid, ed.visible, ed.status, f.filename FROM {plagiarism_eph_document} ed
                    LEFT JOIN {files} f ON f.id = ed.fileid
                    WHERE f.filename IS NULL AND ed.status = 1";
            $documents = $DB->get_records_sql($sql);
            include_once(dirname(__FILE__).'/include/comms/class.EphorusApi.php');
            $ephorus_service = new EphorusService();
            foreach($documents as $document) {
                if(!$document->guid || empty($document->guid)) {
                    $DB->delete_records('plagiarism_eph_document', array('id' => $document->id));
                } else if($document->visible == $ephorus_service::VISIBLE) {
                    $ephorus_service->visibilityService($document->guid, $ephorus_service::INVISIBLE);
                }
            }

            mtrace('Starting handinscript Ephorus');
            require_once($CFG->dirroot.'/plagiarism/ephorus/include/comms/handinservice.php');
            mtrace('Finished handinscript Ephorus');
        }
        mtrace('done.');
    }
    /**
     * function called for events like file upload
     *
     * @param object $eventdata - full Event object
     */
    public function event_handler($eventdata) {
        global $CFG, $DB;

        require_once($CFG->dirroot.'/plagiarism/ephorus/include/comms/class.EphorusApi.php');

        $result = true;

        $cmid = $eventdata['contextinstanceid'];

        // Get the file path name hashes.
        if (isset($eventdata['other']['pathnamehashes']) || !empty($eventdata['other']['pathnamehashes'])) {
            $filepathnamehashes = $eventdata['other']['pathnamehashes'];
        }

        if ($eventdata['eventtype'] == 'file_uploaded' && isset($filepathnamehashes)) {
            $sql = 'SELECT ea.processtype FROM {course_modules} cm
                    LEFT JOIN {plagiarism_eph_assignment} ea ON ea.assignment = cm.instance
                    WHERE cm.id = ?';
            $processtype = $DB->get_field_sql($sql, array($eventdata['contextinstanceid']));
            if ($processtype && $processtype > 0) {
                $fs = get_file_storage();
                foreach ($filepathnamehashes as $filepathnamehash) {
                    $file = $fs->get_file_by_hash($filepathnamehash);
                    if ($file->get_filename() === '.') {
                        continue;
                    }
                    $sql = 'SELECT ed.id, ed.guid, ed.contenthash, ed.filename, ed.status, ed.visible,
                                s.status as substat FROM {plagiarism_eph_document} ed
                            LEFT JOIN {files} f ON f.id = ed.fileid
                            LEFT JOIN {assign_submission} s ON s.id = f.itemid
                            WHERE f.timecreated = ? AND ed.submission = ?';
                    if ($document = $DB->get_record_sql($sql, array($file->get_timecreated(), $eventdata['objectid']))) {
                        $record = new stdClass();
                        $record->id = $document->id;
                        $record->visible = $document->visible;
                        $record->fileid = $file->get_id();

                        $ephorus_service = new EphorusService();

                        if ((($file->get_filename() != $document->filename) && $ephorus_service::isSupportedFiletype($file->get_filename())) ||
                                ($file->get_contenthash() != $document->contenthash)) {
                            if ($document->guid != '') {
                                require_once($CFG->dirroot.'/plagiarism/ephorus/functions.php');
                                change_index(array('guid' => $document->guid, 'index' => 1));
                                $DB->delete_records('plagiarism_eph_result', array('document_guid' => $document->guid));
                            }

                            $record->guid = '';
                            $record->filename = $file->get_filename();
                            $record->contenthash = $file->get_contenthash();
                            $record->status = ($document->substat == 'submitted') ? 0 : -1;
                        }
                        $result = $DB->update_record('plagiarism_eph_document', $record);
                    } else {
                        $user = $DB->get_record('user', array('id' => $eventdata['userid']));
                        $submission = $DB->get_record('assign_submission', array('id' => $eventdata['objectid']));

                        // Check if submission drafts are on and set draft if need be.
                        $submissiondrafts = $DB->get_record('assign', array('id' => $submission->assignment), 'submissiondrafts');
                        if ($submissiondrafts) {
                            $submission->status = "draft";
                        }

                        $result = plagiarism_ephorus_create_file($file, $user, $processtype, $submission);
                    }
                    // Check to see if all ephorus documents exist
                    $sql = "SELECT ed.id, ed.guid, ed.visible, f.filename FROM {plagiarism_eph_document} ed
                            LEFT JOIN {files} f ON f.id = ed.fileid
                            WHERE ed.submission  = ? AND f.filename IS NULL";
                    $documents = $DB->get_records_sql($sql, array($eventdata['objectid']));
                    include_once(dirname(__FILE__).'/include/comms/class.EphorusApi.php');
                    $ephorus_service = new EphorusService();
                    foreach($documents as $document) {
                        if(!$document->guid || empty($document->guid)) {
                            $DB->delete_records('plagiarism_eph_document', array('id' => $document->id));
                        } else if($document->visible == $ephorus_service::VISIBLE) {
                            $ephorus_service->visibilityService($document->guid, $ephorus_service::INVISIBLE);
                        }
                    }
                }
            }
        } else if ($eventdata['eventtype'] == 'files_done') {
            if ($documents = $DB->get_records('plagiarism_eph_document', array('submission' => $eventdata['objectid'], 'status' => '-1'))) {
                foreach ($documents as $document) {
                    $DB->set_field('plagiarism_eph_document', 'status', '0', array('id' => $document->id));
                }
            }
        }
        return $result;
    }
}
/**
 * function for creating files in the ephorus table
 *
 * @param object $file - the file to be addes
 * @param object $user - the user who submitted the file
 * @param int $processtype - the processtype of the file
 * $param object $submission - the submisson of the document
 */
function plagiarism_ephorus_create_file($file, $user, $processtype, $submission = null) {
    global $DB;
    $status = (isset($submission->status) && $submission->status == 'draft') ? -1 : 0;

    $document = new stdClass();
    $document->student_name = $user->lastname.', '.$user->firstname;
    $document->student_number = $user->id;
    $document->status = $status;
    $document->visible = ($processtype == 3) ? 2 : 1;
    $document->contenthash = $file->get_contenthash();
    $document->submission = $file->get_itemid();
    $document->fileid = $file->get_id();
    $document->filename = $file->get_filename();
    $document->processtype = $processtype;

    return $DB->insert_record('plagiarism_eph_document', $document, false);
}
