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

/**
 * version.php
 *
 * @package    plagiarism_ephorus
 * @subpackage version
 * @author     Guido Bonnet
 * @copyright  2012 onwards Ephorus  {@link http://ephorus.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$plugin->version   = 2014051500.02; //2014-07-03
$plugin->requires  = 2013101800.00;
$plugin->cron      = 0;
$plugin->component = 'plagiarism_ephorus';
$plugin->maturity  = MATURITY_STABLE;
$plugin->release   = 'Module for 2.6+';

$plugin->dependencies = array(
    'mod_assign' => ANY_VERSION
);