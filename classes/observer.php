<?php
// This file is part of Moodle - http://moodle.org/
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
if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.'); // It must be included from a Moodle page.
}
require_once($CFG->dirroot.'/plagiarism/ephorus/lib.php');
class plagiarism_ephorus_observer {
	/**
	 * Handle the assignment assessable_uploaded event for files.
	 * @param \assignsubmission_file\event\assessable_uploaded $event
	 */
	public static function assignsubmission_file_uploaded(
	    \assignsubmission_file\event\assessable_uploaded $event) {
	    $eventdata = $event->get_data();
	    $eventdata['eventtype'] = 'file_uploaded';
	    $eventdata['other']['modulename'] = 'assign';
	    $plugin = new plagiarism_plugin_ephorus();
	    $plugin->event_handler($eventdata);
	}
    /**
     * Handle the assignment assessable_uploaded event for online text.
     * @param \assignsubmission_onlinetext\event\assessable_uploaded $event
     */
    public static function assignsubmission_onlinetext_uploaded(
        \assignsubmission_onlinetext\event\assessable_uploaded $event) {
        $eventdata = $event->get_data();
        $eventdata['eventtype'] = 'content_uploaded';
        $eventdata['other']['modulename'] = 'assign';
        $plugin = new plagiarism_plugin_ephorus();
        $plugin->event_handler($eventdata);
    }
    /**
     * Handle the assignment assessable_submitted event.
     * @param \mod_assign\event\assessable_submitted $event
     */
    public static function assignsubmission_submitted(
        \mod_assign\event\assessable_submitted $event) {
        $eventdata = $event->get_data();
        $eventdata['eventtype'] = 'assessable_submitted';
        $eventdata['other']['modulename'] = 'assign';
        $plugin = new plagiarism_plugin_ephorus();
        $plugin->event_handler($eventdata);
    }
	/**
	 * Handle the course_module_created event.
	 * @param \core\event\course_module_created $event
	 */
	public static function course_module_created(
        \core\event\course_module_created $event) {
		$eventdata = $event->get_data();
        $eventdata['eventtype'] = 'mod_created';
        $plugin = new plagiarism_plugin_ephorus();
        $plugin->event_handler($eventdata);
	}
	/**
	 * Handle the course_module_updated event.
	 * @param \core\event\course_module_updated $event
	 */
	public static function course_module_updated(
        \core\event\course_module_updated $event) {
		$eventdata = $event->get_data();
        $eventdata['eventtype'] = 'mod_updated';
        $plugin = new plagiarism_plugin_ephorus();
        $plugin->event_handler($eventdata);
	}
	/**
	 * Handle the course_module_deleted event.
	 * @param \core\event\course_module_deleted $event
	 */
	public static function course_module_deleted(
        \core\event\course_module_deleted $event) {
		global $DB;
        $DB->delete_records('plagiarism_eph_assignment', array('assignment' => $eventdata['contextinstanceid']));
	}
}