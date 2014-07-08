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
 * @subpackage report
 * @author     Guido Bonnet
 * @copyright  2012 onwards Ephorus  {@link http://ephorus.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
require_once($CFG->dirroot.'/plagiarism/ephorus/include/class.DLEApi.php');
require_once($CFG->dirroot.'/plagiarism/ephorus/include/comms/class.EphorusApi.php');

$guid = required_param('guid', PARAM_RAW);  // Document GUID
$mode = optional_param('mode', 'summary', PARAM_RAW);  // Report type
$url = new moodle_url('/plagiarism/ephorus/report.php', array('guid' => $guid)); // page URL


$document = DLEApi::getDocument($guid);
$results = DLEApi::getResults($document->guid);


$cm = $DB->get_record_sql("SELECT cm.* FROM {course_modules} cm
    LEFT JOIN {modules} modu ON modu.id = cm.module
    LEFT JOIN {assign_submission} sub ON sub.assignment = cm.instance
    LEFT JOIN {plagiarism_eph_document} ed ON ed.submission = sub.id 
    WHERE modu.name = 'assign' AND ed.guid = ?", array($guid));

$course = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);

require_login($course, true, $cm);
$PAGE->set_url($url);

$context = context_module::instance($cm->id);

require_capability('mod/assign:grade', $context);

$PAGE->set_title(get_string('pluginname', 'plagiarism_ephorus'));
$PAGE->set_heading(get_string('ephorus_report', 'plagiarism_ephorus'));
echo $OUTPUT->header();

$ephorusReport = new EphorusReport($document->guid, $mode);
$results = DLEApi::getResults($document->guid);

if($document->status == 1 || count($results) > 0):
    if($mode == 'detailed'): ?>
        <script type="text/javascript">
        YUI().use('node', function(Y) {
          Y.on("domready", function(){
            Y.all('input[name=diff]').on('change', function(e) {
              var form = e.currentTarget.get('form');
              form.submit();
            });
          });
        });
        </script>
    <?php endif; ?>
    <div class="ModeSelection">
        <?php echo ($mode == 'summary') ?
        '<span>'.get_string('summary', 'plagiarism_ephorus').'</span>':
        '<a href="?mode=summary&amp;guid='.$document->guid.'">'.get_string('summary', 'plagiarism_ephorus').'</a>'; ?>
        /
        <?php echo ($mode == 'detailed') ?
        '<span>'.get_string('detailed', 'plagiarism_ephorus').'</span>':
        '<a href="?mode=detailed&amp;guid='.$document->guid.'">'.get_string('detailed', 'plagiarism_ephorus').'</a>'; ?>
    </div>
<?php endif; ?>
<div class="ephorus">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <th colspan="2" class="tableTop minFont"><?php echo get_string('document_information', 'plagiarism_ephorus'); ?></th>
        </tr>
        <tr>
            <td width="120" height="18"><?php echo get_string('student', 'plagiarism_ephorus'); ?></td>
            <td height="18"><?php echo $document->student_name; ?> (<?php echo $document->student_number; ?>)</td>
        </tr>
        <tr>
            <td height="18"><?php echo get_string('document', 'plagiarism_ephorus'); ?></td>
            <td height="18"><?php echo DLEApi::getLink($document->id); ?></td>
        </tr>
        <tr>
            <td height="18"><?php echo get_string('submission_date', 'plagiarism_ephorus'); ?></td>
            <td height="18"><?php echo DLEApi::formatDate($document->date_created); ?></td>
        </tr>
    </table>
    <?php
    if($document->status != 1 || count($results) == 0):
        $content = $ephorusReport->getReport();
    else:
        if($mode == 'detailed') {
            $result = isset($_POST['diff']) ? $_POST["diff"] : reset($results)->guid;
            $matches = $ephorusReport->getHeader($result);
            $content = $ephorusReport->getReport(array(), $results[$result]->comparison);
        } else {
            $guids = $_SERVER['REQUEST_METHOD'] == 'POST' ? (isset($_POST["guids_use"]) ? $_POST['guids_use'] : array()) : array_keys($results);
            $matches = $ephorusReport->getHeader($guids);
            $content = $ephorusReport->getReport($guids);
        }
    ?>
    <form action="" method="post">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <th width="40"><?php echo $document->percentage; ?>% </th>
            <th><?php echo get_string('total_score', 'plagiarism_ephorus'); ?></th>
        </tr>
    <?php foreach($matches as $match): ?>
        <tr>
            <td><?php echo $match['percentage']; ?>%</td>
            <td>
                <input type="<?php echo $match['input']['type']; ?>" <?php echo ($match['input']['checked'] == 1)?'checked' : ''; ?>
                       value="<?php echo $match['input']['value']; ?>" name="<?php echo $match['input']['name']; ?>">
                <?php echo ($match['source']['link']) ?
                '<a href="'.$match['source']['link'].'" target="_blank">'.$match['source']['title'].'</a>' :
                '<span>'.$match['source']['title'].'</span>'; ?>
            </td>
        </tr>
    <?php endforeach;
        if($mode == 'summary'): ?>
        <tr>
            <td colspan="2" class="foot"><input class="btn btn-mini pull-right" type="submit" value="<?php echo get_string('update_sources', 'plagiarism_ephorus'); ?>"></td>
        </tr>
    <?php endif; ?>
    </table>
    </form>
</div>
<?php endif; ?>
<div class="ephReport">
    <?php echo $content; ?>
</div>
<?php echo $OUTPUT->footer(); ?>