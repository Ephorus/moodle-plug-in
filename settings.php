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
 * settings.php - allows the admin to configure plagiarism stuff
 *
 * @package    plagiarism_ephorus
 * @subpackage settings
 * @author     Guido Bonnet
 * @copyright  2012 onwards Ephorus  {@link http://ephorus.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->libdir.'/plagiarismlib.php');
require_once($CFG->dirroot.'/plagiarism/ephorus/lib.php');

require_login();
admin_externalpage_setup('plagiarismephorus');
$context = context_system::instance();
require_capability('moodle/site:config', $context, $USER->id, true, "nopermissions");

/* Form handling */
require_once('ephorus_form.php');
$mform = new ephorus_form();

/* Output starts here */
echo $OUTPUT->header();

if ((!$mform->is_cancelled()) && ($data = $mform->get_data()) && confirm_sesskey()) {
    $data->logging = (bool) isset($data->logging);
    $data->use_cron = (bool) isset($data->use_cron);
    $data->auto_finalize = (bool) isset($data->auto_finalize);
    foreach ($data as $field => $value) {
        if (strpos($field, 'submit') == false) {
            set_config($field, $value, 'plagiarism_ephorus');
        }
    }
    echo $OUTPUT->notification(get_string('saved_settings', 'plagiarism_ephorus'), 'notifysuccess');

    //Test Connection
    require_once(dirname(__FILE__).'/include/comms/class.EphorusApi.php');

    $status = new EphorusStatus();
    $connection = $status->connectivityTest();
    if($connection['handin'] && $connection['index']) {
        echo $OUTPUT->notification(get_string('handin_index_okay', 'plagiarism_ephorus'), 'notifysuccess');
    } elseif($connection['handin']) {
        echo $OUTPUT->notification(get_string('handin_okay', 'plagiarism_ephorus'), 'notifysuccess');
        echo $OUTPUT->notification(get_string('index_not_okay', 'plagiarism_ephorus'), 'notifyproblem');
    } elseif($connection['index']) {
        echo $OUTPUT->notification(get_string('index_okay', 'plagiarism_ephorus'), 'notifysuccess');
        echo $OUTPUT->notification(get_string('handin_not_okay', 'plagiarism_ephorus'), 'notifyproblem');
    } else {
        echo $OUTPUT->notification(get_string('handin_index_not_okay', 'plagiarism_ephorus'), 'notifyproblem');
    }
}
echo '<h2 class="main">'.get_string('ephorus_settings', 'plagiarism_ephorus').'</h2>';
if (!extension_loaded('xsl')) {
    echo $OUTPUT->box_start('generalbox boxaligncenter');
    echo "<center><h4>" . get_string('xsl_not_enabled', 'plagiarism_ephorus') . "</h4></center>";
    echo $OUTPUT->box_end();
}
echo $OUTPUT->box_start('generalbox boxaligncenter');
$mform->set_data((array) get_config('plagiarism_ephorus'));
$mform->display();
echo $OUTPUT->box_end();
echo $OUTPUT->footer();
