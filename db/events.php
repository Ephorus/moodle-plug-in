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

/*
* Event Handlers
*/
$handlers = array (
    'assessable_file_uploaded' => array (
        'handlerfile'      => '/plagiarism/ephorus/lib.php',
        'handlerfunction'  => 'plagiarism_ephorus_event_file_uploaded',
        'schedule'         => 'instant'
    ),
    'assessable_files_done' => array (
        'handlerfile'      => '/plagiarism/ephorus/lib.php',
        'handlerfunction'  => 'plagiarism_ephorus_event_files_done',
        'schedule'         => 'instant'
    ),
    'mod_created' => array (
        'handlerfile'      => '/plagiarism/ephorus/lib.php',
        'handlerfunction'  => 'plagiarism_ephorus_event_mod_created',
        'schedule'         => 'instant'
    ),
    'mod_updated' => array (
        'handlerfile'      => '/plagiarism/ephorus/lib.php',
        'handlerfunction'  => 'plagiarism_ephorus_event_mod_updated',
        'schedule'         => 'instant'
    ),
    'mod_deleted' => array (
        'handlerfile'      => '/plagiarism/ephorus/lib.php',
        'handlerfunction'  => 'plagiarism_ephorus_event_mod_deleted',
        'schedule'         => 'instant'
    ),
);