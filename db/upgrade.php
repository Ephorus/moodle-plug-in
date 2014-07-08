<?php
// This file is part of Ephorus
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

function xmldb_plagiarism_ephorus_upgrade($oldversion = 0) {
    global $DB;
    $dbman = $DB->get_manager();

    $result = true;

    if ($result && $oldversion < 2012073124) {
        /* Rename the table fields to a better size (< 30) */
        $document = new xmldb_table('ephorus_document');
        $duplicateguid = new xmldb_field('duplicate_original_guid', XMLDB_TYPE_CHAR);
        if ($dbman->field_exists($document, $duplicateguid)) {
            $dbman->rename_field($document, $duplicateguid, 'duplicate_guid');
        }
        $duplicatename = new xmldb_field('duplicate_original_studentname', XMLDB_TYPE_CHAR);
        if ($dbman->field_exists($document, $duplicatename)) {
            $dbman->rename_field($document, $duplicatename, 'duplicate_studentname');
        }
        $duplicatenumber = new xmldb_field('duplicate_original_studentnumber', XMLDB_TYPE_CHAR);
        if ($dbman->field_exists($document, $duplicatenumber)) {
            $dbman->rename_field($document, $duplicatenumber, 'duplicate_studentnumber');
        }

        set_config('ephorus_usecron', 1, 'plagiarism');
        set_config('ephorus_logging', 1, 'plagiarism');

	upgrade_plugin_savepoint(true, 2012073124, 'plagiarism', 'ephorus');
    }
    if ($result && $oldversion < 2013041024) {
        $document = new xmldb_table('ephorus_document');
        $duplicatename = new xmldb_field('duplicate_studentname', XMLDB_TYPE_CHAR);
        if ($dbman->field_exists($document, $duplicatename)) {
            $dbman->rename_field($document, $duplicatename, 'duplicate_student_name');
        }
        $duplicatenumber = new xmldb_field('duplicate_studentnumber', XMLDB_TYPE_CHAR);
        if ($dbman->field_exists($document, $duplicatenumber)) {
            $dbman->rename_field($document, $duplicatenumber, 'duplicate_student_number');
        }
        $status_desc = new xmldb_field('status_description', XMLDB_TYPE_CHAR);
        if ($dbman->field_exists($document, $status_desc)) {
            $dbman->rename_field($document, $status_desc, 'error');
        }

        $res_table = new xmldb_table('ephorus_result');
        $diff = new xmldb_field('diff', XMLDB_TYPE_TEXT, 'long');
        if ($dbman->field_exists($res_table, $diff)) {
            $dbman->rename_field($res_table, $diff, 'comparison');
        }

        $DB->set_field('ephorus_document', 'status', 99, array('status' => 7));

	upgrade_plugin_savepoint(true, 2013041024, 'plagiarism', 'ephorus');
    }
    if ($result && $oldversion < 2013052224) {
        $document = new xmldb_table('ephorus_document');
        $date = new xmldb_field('date', XMLDB_TYPE_CHAR);
        if ($dbman->field_exists($document, $date)) {
            $dbman->rename_field($document, $date, 'date_created');
        }

        if($ephorus_id = $DB->get_field('tool_customlang_components', 'id', array('name' => 'plagiarism_ephorus'))) {
            $DB->delete_records('tool_customlang', array('componentid' => $ephorus_id));
        }

	upgrade_plugin_savepoint(true, 2013052224, 'plagiarism', 'ephorus');
    }
    if ($result && $oldversion < 2013080524) {
        set_config('use_cron', get_config('plagiarism')->ephorus_usecron, 'plagiarism_ephorus');
        unset_config('ephorus_usecron', 'plagiarism');
        
        set_config('logging', get_config('plagiarism')->ephorus_logging, 'plagiarism_ephorus');
        unset_config('ephorus_logging', 'plagiarism');
        
        set_config('handin_code', get_config('plagiarism')->ephorus_handincode, 'plagiarism_ephorus');
        unset_config('ephorus_handincode', 'plagiarism');
        
        set_config('handin_address', get_config('plagiarism')->ephorus_handinaddress, 'plagiarism_ephorus');
        unset_config('ephorus_handinaddress', 'plagiarism');
        
        set_config('index_address', get_config('plagiarism')->ephorus_indexaddress, 'plagiarism_ephorus');
        unset_config('ephorus_indexaddress', 'plagiarism');
        
        set_config('processtype', get_config('plagiarism')->ephorus_processtype, 'plagiarism_ephorus');
        unset_config('ephorus_processtype', 'plagiarism');
        
        set_config('student_disclosure', get_config('plagiarism')->ephorus_studentdisclosure, 'plagiarism_ephorus');
        unset_config('ephorus_studentdisclosure', 'plagiarism');

	upgrade_plugin_savepoint(true, 2013080524, 'plagiarism', 'ephorus');
    }
    if ($result && $oldversion < 2013080924.04) {
        $document_table = new xmldb_table('ephorus_document');
        $result_table = new xmldb_table('ephorus_result');
        $percentage_field = new xmldb_field('percentage', XMLDB_TYPE_INTEGER, 3);

        if ($dbman->field_exists($document_table, $percentage_field)) {
            $dbman->change_field_type($document_table, $percentage_field);
            $dbman->change_field_precision($document_table, $percentage_field);
        }
        
         if ($dbman->field_exists($result_table, $percentage_field)) {
            $dbman->change_field_type($result_table, $percentage_field);
            $dbman->change_field_precision($result_table, $percentage_field);
        }

        $compressed_field = new xmldb_field('compressed', XMLDB_TYPE_INTEGER, 1, XMLDB_UNSIGNED, false, false, 0, 'summary');
        if (!$dbman->field_exists($document_table, $compressed_field)) {
            $dbman->add_field($document_table, $compressed_field);
        }
        
        $compressed_field = new xmldb_field('compressed', XMLDB_TYPE_INTEGER, 1, XMLDB_UNSIGNED, false, false, 0, 'comparison');
        if (!$dbman->field_exists($result_table, $compressed_field)) {
            $dbman->add_field($result_table, $compressed_field);
        }

	upgrade_plugin_savepoint(true, 2013080924.04, 'plagiarism', 'ephorus');
    }
    if ($result && $oldversion < 2013080924.08) {
        // Ephorus Assignment
        $assignment_table = new xmldb_table('ephorus_assignment');
        $assignment_assignment = new xmldb_field('assignment', XMLDB_TYPE_INTEGER, 10);
        if ($dbman->field_exists($assignment_table, $assignment_assignment)) {
            $dbman->change_field_type($assignment_table, $assignment_assignment);
            $dbman->change_field_precision($assignment_table, $assignment_assignment);
        }
        $assignment_processtype = new xmldb_field('processtype', XMLDB_TYPE_INTEGER, 1);
        if ($dbman->field_exists($assignment_table, $assignment_processtype)) {
            $dbman->change_field_type($assignment_table, $assignment_processtype);
            $dbman->change_field_precision($assignment_table, $assignment_processtype);
        }
        
        // Ephorus Document
        $document_table = new xmldb_table('ephorus_document');
        $document_filename = new xmldb_field('filename', XMLDB_TYPE_CHAR, 255);
        if ($dbman->field_exists($document_table, $document_filename)) {
            $dbman->change_field_type($document_table, $document_filename);
            $dbman->change_field_precision($document_table, $document_filename);
        }
        $document_contenthash = new xmldb_field('contenthash', XMLDB_TYPE_CHAR, 55);
        if ($dbman->field_exists($document_table, $document_contenthash)) {
            $dbman->change_field_type($document_table, $document_contenthash);
            $dbman->change_field_precision($document_table, $document_contenthash);
        }
        $document_student_name = new xmldb_field('student_name', XMLDB_TYPE_CHAR, 60);
        if ($dbman->field_exists($document_table, $document_student_name)) {
            $dbman->change_field_type($document_table, $document_student_name);
            $dbman->change_field_precision($document_table, $document_student_name);
        }
        $document_student_number = new xmldb_field('student_number', XMLDB_TYPE_CHAR, 25);
        if ($dbman->field_exists($document_table, $document_student_number)) {
            $dbman->change_field_type($document_table, $document_student_number);
            $dbman->change_field_precision($document_table, $document_student_number);
        }
        $document_date_created = new xmldb_field('date_created', XMLDB_TYPE_CHAR, 255);
        if ($dbman->field_exists($document_table, $document_date_created)) {
            $dbman->change_field_type($document_table, $document_date_created);
            $dbman->change_field_precision($document_table, $document_date_created);
        }
        $document_percentage = new xmldb_field('percentage', XMLDB_TYPE_INTEGER, 3);
        if ($dbman->field_exists($document_table, $document_percentage)) {
            $dbman->change_field_type($document_table, $document_percentage);
            $dbman->change_field_precision($document_table, $document_percentage);
        }
        $document_duplicate_original_guid = new xmldb_field('duplicate_original_guid', XMLDB_TYPE_CHAR);
        if ($dbman->field_exists($document_table, $document_duplicate_original_guid)) {
            $dbman->rename_field($document_table, $document_duplicate_original_guid, 'duplicate_guid');
        }
        $document_duplicate_guid = new xmldb_field('duplicate_guid', XMLDB_TYPE_CHAR, 36);
        if ($dbman->field_exists($document_table, $document_duplicate_guid)) {
            $dbman->change_field_type($document_table, $document_duplicate_guid);
            $dbman->change_field_precision($document_table, $document_duplicate_guid);
        }
        $document_duplicate_original_studentname = new xmldb_field('duplicate_original_studentname', XMLDB_TYPE_CHAR);
        if ($dbman->field_exists($document_table, $document_duplicate_original_studentname)) {
            $dbman->rename_field($document_table, $document_duplicate_original_studentname, 'duplicate_studentname');
        }
        $document_duplicate_student_name = new xmldb_field('duplicate_student_name', XMLDB_TYPE_CHAR, 60);
        if ($dbman->field_exists($document_table, $document_duplicate_student_name)) {
            $dbman->change_field_type($document_table, $document_duplicate_student_name);
            $dbman->change_field_precision($document_table, $document_duplicate_student_name);
        }
        $document_duplicate_original_studentnumber = new xmldb_field('duplicate_original_studentnumber', XMLDB_TYPE_CHAR);
        if ($dbman->field_exists($document_table, $document_duplicate_original_studentnumber)) {
            $dbman->rename_field($document_table, $document_duplicate_original_studentnumber, 'duplicate_studentnumber');
        }
        $document_duplicate_student_number = new xmldb_field('duplicate_student_number', XMLDB_TYPE_CHAR, 25);
        if ($dbman->field_exists($document_table, $document_duplicate_student_number)) {
            $dbman->change_field_type($document_table, $document_duplicate_student_number);
            $dbman->change_field_precision($document_table, $document_duplicate_student_number);
        }
        $document_status = new xmldb_field('status', XMLDB_TYPE_INTEGER, 2);
        if ($dbman->field_exists($document_table, $document_status)) {
            $dbman->change_field_type($document_table, $document_status);
            $dbman->change_field_precision($document_table, $document_status);
        }
        $document_error = new xmldb_field('error', XMLDB_TYPE_CHAR, 255, NULL);
        $document_status_description = new xmldb_field('status_description', XMLDB_TYPE_CHAR);
        if ($dbman->field_exists($document_table, $document_status_description) && $dbman->field_exists($document_table, $document_error)) {
            $dbman->drop_field($document_table, $document_status_description);
        } else if($dbman->field_exists($document_table, $document_status_description)) {
            $dbman->rename_field($document_table, $document_status_description, 'error');
        }
        if ($dbman->field_exists($document_table, $document_error)) {
            $dbman->change_field_type($document_table, $document_error);
            $dbman->change_field_precision($document_table, $document_error);
        }
        $document_summary = new xmldb_field('summary', XMLDB_TYPE_TEXT, 'big');
        if ($dbman->field_exists($document_table, $document_summary)) {
            $dbman->change_field_type($document_table, $document_summary);
            $dbman->change_field_precision($document_table, $document_summary);
        }
        $document_compressed = new xmldb_field('compressed', XMLDB_TYPE_INTEGER, 1);
        if ($dbman->field_exists($document_table, $document_compressed)) {
            $dbman->change_field_type($document_table, $document_compressed);
            $dbman->change_field_precision($document_table, $document_compressed);
        }
        $document_visible = new xmldb_field('visible', XMLDB_TYPE_INTEGER, 1);
        if ($dbman->field_exists($document_table, $document_visible)) {
            $dbman->change_field_type($document_table, $document_visible);
            $dbman->change_field_precision($document_table, $document_visible);
        }
        $document_processtype = new xmldb_field('processtype', XMLDB_TYPE_INTEGER, 1);
        if ($dbman->field_exists($document_table, $document_processtype)) {
            $dbman->change_field_type($document_table, $document_processtype);
            $dbman->change_field_precision($document_table, $document_processtype);
        }
        $document_submission = new xmldb_field('submission', XMLDB_TYPE_INTEGER, 10);
        if ($dbman->field_exists($document_table, $document_submission)) {
            $dbman->change_field_type($document_table, $document_submission);
            $dbman->change_field_precision($document_table, $document_submission);
        }

        // Ephorus Result
        $result_table = new xmldb_table('ephorus_result');
        $result_guid = new xmldb_field('guid', XMLDB_TYPE_CHAR, 50);
        if ($dbman->field_exists($result_table, $result_guid)) {
            $dbman->change_field_type($result_table, $result_guid);
            $dbman->change_field_precision($result_table, $result_guid);
        }
        $result_original_guid = new xmldb_field('original_guid', XMLDB_TYPE_CHAR, 50);
        if ($dbman->field_exists($result_table, $result_original_guid)) {
            $dbman->change_field_type($result_table, $result_original_guid);
            $dbman->change_field_precision($result_table, $result_original_guid);
        }
        $result_url = new xmldb_field('url', XMLDB_TYPE_TEXT, 'medium');
        if ($dbman->field_exists($result_table, $result_url)) {
            $dbman->change_field_type($result_table, $result_url);
            $dbman->change_field_precision($result_table, $result_url);
        }
        $result_type = new xmldb_field('type', XMLDB_TYPE_CHAR, 100);
        if ($dbman->field_exists($result_table, $result_type)) {
            $dbman->change_field_type($result_table, $result_type);
            $dbman->change_field_precision($result_table, $result_type);
        }
        $result_percentage = new xmldb_field('percentage', XMLDB_TYPE_INTEGER, 3);
        if ($dbman->field_exists($result_table, $result_percentage)) {
            $dbman->change_field_type($result_table, $result_percentage);
            $dbman->change_field_precision($result_table, $result_percentage);
        }
        $result_comparison = new xmldb_field('comparison', XMLDB_TYPE_TEXT, 'big');
        if ($dbman->field_exists($result_table, $result_comparison)) {
            $dbman->change_field_type($result_table, $result_comparison);
            $dbman->change_field_precision($result_table, $result_comparison);
        }
        $result_compressed = new xmldb_field('compressed', XMLDB_TYPE_INTEGER, 1);
        if ($dbman->field_exists($result_table, $result_compressed)) {
            $dbman->change_field_type($result_table, $result_compressed);
            $dbman->change_field_precision($result_table, $result_compressed);
        }
        $result_student_name = new xmldb_field('student_name', XMLDB_TYPE_CHAR, 100);
        if ($dbman->field_exists($result_table, $result_student_name)) {
            $dbman->change_field_type($result_table, $result_student_name);
            $dbman->change_field_precision($result_table, $result_student_name);
        }
        $result_student_number = new xmldb_field('student_number', XMLDB_TYPE_CHAR, 100);
        if ($dbman->field_exists($result_table, $result_student_number)) {
            $dbman->change_field_type($result_table, $result_student_number);
            $dbman->change_field_precision($result_table, $result_student_number);
        }

	upgrade_plugin_savepoint(true, 2013080924.08, 'plagiarism', 'ephorus');
    }
    if ($result && $oldversion < 2014051500.02) {
        $assignment_table = new xmldb_table('ephorus_assignment');
        $dbman->rename_table($assignment_table, 'plagiarism_eph_assignment');
        
        $document_table = new xmldb_table('ephorus_document');
        $dbman->rename_table($document_table, 'plagiarism_eph_document');

        $result_table = new xmldb_table('ephorus_result');
        $dbman->rename_table($result_table, 'plagiarism_eph_result');

        upgrade_plugin_savepoint(true, 2014051500.02, 'plagiarism', 'ephorus');
    }
    return $result;
}

