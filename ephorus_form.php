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
 * ephorus_form.php - The form class for the settings page
 *
 * @package    plagiarism_ephorus
 * @subpackage ephorus form
 * @author     Guido Bonnet
 * @copyright  2012 onwards Ephorus  {@link http://ephorus.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once($CFG->dirroot.'/lib/formslib.php');

class ephorus_form extends moodleform {

    /* Define the form */
    public function definition () {
        $mform =& $this->_form;

        $mform->addElement('checkbox', 'logging', get_string('ephorus_logging', 'plagiarism_ephorus'));
        $mform->addHelpButton('logging', 'ephorus_logging', 'plagiarism_ephorus');

        $mform->addElement('checkbox', 'use_cron', get_string('use_cron', 'plagiarism_ephorus'));
        $mform->addHelpButton('use_cron', 'use_cron', 'plagiarism_ephorus');

        //$mform->addElement('checkbox', 'auto_finalize', get_string('auto_finalize', 'plagiarism_ephorus'));
        //$mform->addHelpButton('auto_finalize', 'auto_finalize', 'plagiarism_ephorus');

        $mform->addElement('text', 'handin_code', get_string('handin_code', 'plagiarism_ephorus'), 'size="30"');
        $mform->setType('handin_code', PARAM_RAW);

        $mform->addElement('text', 'handin_address', get_string('handin_address', 'plagiarism_ephorus'), 'size="77"');
        $mform->setType('handin_address', PARAM_RAW);

        $mform->addElement('text', 'index_address', get_string('index_address', 'plagiarism_ephorus'), 'size="77"');
        $mform->setType('index_address', PARAM_RAW);

        $mform->addElement('select', 'processtype', get_string('default_processtype', 'plagiarism_ephorus'), array(
            1 => get_string('default', 'plagiarism_ephorus'),
            3 => get_string('private', 'plagiarism_ephorus')
        ));
        $mform->addHelpButton('processtype', 'default_processtype', 'plagiarism_ephorus');

        $mform->addElement('textarea', 'student_disclosure', get_string('student_disclosure', 'plagiarism_ephorus'), 'cols="80" rows="3"');
        $mform->addHelpButton('student_disclosure', 'student_disclosure', 'plagiarism_ephorus');

        $this->add_action_buttons(true, get_string('savechanges').' / '.get_string('check_connection', 'plagiarism_ephorus'));
    }
}
