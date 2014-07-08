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
 * functions.php - Contains Ephorus specific functions called by Modules.
 *
 * @since 2.3
 * @package    plagiarism_ephorus
 * @subpackage functions
 * @author     Guido Bonnet
 * @copyright  2012 onwards Ephorus  {@link http://ephorus.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(dirname(dirname(dirname(__FILE__))).'/config.php');

if (!isloggedin()) {
    header("HTTP/1.1 401 Unauthorized");
    exit("Login required");
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    unset($_GET['action']);

    if (!in_array($action, array('change_index', 'send_to_ephorus'))) {
        header("HTTP/1.1 501 Not Implemented");
        exit("Unknown action $action");
    }

    call_user_func($action, $_GET);
}

/**
 * function to change the visibility of a document in ephorus
 *
 * @param array $data - data send by get
 *   - 'required' - string $guid - globally unique identifier of the document
 *   - 'optional' - int $index - the current index of the document
 */
function change_index($data = array()) {
    global $CFG, $DB;

    require_once(dirname(__FILE__).'/include/comms/class.EphorusApi.php');

    $index = isset($data['index']) ? $data['index'] : $DB->get_field('plagiarism_eph_document', 'visible', array('guid' => $data['document_guid']));
    $index = ($index == 1) ? 2 : 1;
    if ($index) {
        $ephorus_service = new EphorusService();
        $ephorus_service->visibilityService($data['document_guid'], $index);
    }

    /*if(isArray($result) || !$index) {
        header("HTTP/1.0 500 Internal Server Error");
        return get_string('indexError', 'plagiarism_ephorus');
    }*/
    header('Location: '.$_SERVER['HTTP_REFERER']);
}

/**
 * function to manually send a file to ephorus
 *
 * @param array $data - data send by get
 *   - 'required' - string $file_id - the id of the file that needs to be sent
 */
function send_to_ephorus($data = array()) {
    global $CFG, $DB;

    require_once($CFG->libdir.'/filelib.php');
    require_once($CFG->dirroot.'/plagiarism/ephorus/lib.php');

    $fs = get_file_storage();
    if ($file = $fs->get_file_by_id($data['file_id'])) {
        if (!$DB->record_exists('plagiarism_eph_document', array('fileid' => $file->get_id()))) {
            $user = $DB->get_record('user', array('id' => $file->get_userid()));
            $sql = 'SELECT ea.processtype FROM {plagiarism_eph_assignment} ea
                    LEFT JOIN {assign} a ON a.id = ea.assignment
                    LEFT JOIN {assign_submission} s ON s.assignment = a.id
                    WHERE s.id = ?';
            $processtype = $DB->get_field_sql($sql, array($file->get_itemid()));
            $submission = $DB->get_record('assign_submission', array('id' => $file->get_itemid()));
            plagiarism_ephorus_create_file($file, $user, $processtype, $submission);

            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
    }
    return false;
}
