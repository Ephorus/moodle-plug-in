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

function xmldb_plagiarism_ephorus_install() {
    global $CFG;

    set_config('enableplagiarism', 1);
    set_config('enableplagiarism', 1, 'plagiarism');
    set_config('ephorus_use', 1, 'plagiarism');
    
    set_config('use_cron', 1, 'plagiarism_ephorus');
    set_config('logging', 1, 'plagiarism_ephorus');
    set_config('handin_code', '', 'plagiarism_ephorus');
    set_config('handin_address', 'http://services.ephorus.com/handinservice/handinservice.asmx?wsdl', 'plagiarism_ephorus');
    set_config('index_address', 'http://services.ephorus.com/indexdocumentservice/indexdocumentservice.asmx?wsdl', 'plagiarism_ephorus');
    set_config('processtype', 1, 'plagiarism_ephorus');
    set_config('student_disclosure', '', 'plagiarism_ephorus');
}
