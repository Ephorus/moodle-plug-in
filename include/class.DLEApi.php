<?php
/**
 * class.DLEApi.php - The configurable file of ephorus comms
 *
 * @package    ephorus plagiarism plugin
 * @subpackage ephoruscomms
 * @author     Guido Bonnet
 * @copyright  2012 Guido Bonnet http://ephorus.com
 */

class DLEApi {

	public static function initialize() {
		if(!isset($_SERVER['REQUEST_URI']) && !defined('CLI_SCRIPT')) {
			define('CLI_SCRIPT', true);
		}

		global $SESSION;
		if(!isset($SESSION)) {
			$SESSION = new stdClass();
		}
		
		require_once(dirname(dirname(dirname(dirname(__FILE__)))).'/config.php');
	}
	
	public static function cronAuth() {
		// This script is being called via the web, so check the password if there is one.
		global $CFG;
		if ((!defined('CLI_SCRIPT') || !CLI_SCRIPT) && !empty($CFG->cronremotepassword)) {
			$pass = optional_param('password', '', PARAM_RAW);
			if ($pass != $CFG->cronremotepassword) {
				// wrong password.
				print_error('cronerrorpassword', 'admin');
				exit;
			}
		}
	}

	/**
	 * Function to get the Ephorus settings
	 *
	 * @param $setting
	 * @return string
	 */
	public static function getSetting($setting) {
		$return = '';
		switch($setting) {
			case('ephorus_use_cron'):
				$return = get_config('plagiarism_ephorus')->use_cron;
				break;
			case('auto_finalize'):
				$return = get_config('plagiarism_ephorus')->auto_finalize;
				break;
			case('ephorus_logging'):
				$return = get_config('plagiarism_ephorus')->logging;
				break;
			case('handin_code'):
				$return = get_config('plagiarism_ephorus')->handin_code;
				break;
			case('handin_address'):
				$return = get_config('plagiarism_ephorus')->handin_address;
				break;
			case('index_address'):
				$return = get_config('plagiarism_ephorus')->index_address;
				break;
		}
		return $return;
	}

	/**
	 * Function to get the DLE's proxy settings
	 *
	 * @param $setting
	 * @return bool|string
	 */
	public static function getProxySetting($setting) {
		global $CFG;
		switch ($setting) {
			case 'host':
				return empty($CFG->proxyhost)? false : $CFG->proxyhost;
				break;
			case 'port':
				return empty($CFG->proxyport)? false : $CFG->proxyport;
				break;
			case 'username':
				return empty($CFG->proxyuser)? false : $CFG->proxyuser;
				break;
			case 'password':
				return empty($CFG->proxypassword)? false : $CFG->proxypassword;
				break;
			default:
				return false;
		}
	}

	/**
	 * Function to return the documents that have to be send to Ephorus
	 *
	 * @return array
	 */
	public static function getUnsentDocuments() {
		global $DB;
		if(self::getSetting('auto_finalize')) {
			self::finalizeOpenAssignments();
		}
		return $DB->get_records('plagiarism_eph_document', array('guid' => '', 'status' => 0));
	}

	public static function finalizeOpenAssignments() {
		global $DB;
		$documents = $DB->get_records('plagiarism_eph_document', array('status' => '-1'), '', 'id, submission');
		foreach ($documents as $document) {
			if ($submission = $DB->get_field('assign_submission', 'assignment', array('id' => $document->submission))) {
				$assignment = $DB->get_record('assign', array('id' => $submission), 'id, cutoffdate, requiresubmissionstatement');
				// Check whether the time due has expired and if it should finalize then.
				if (!$assignment->requiresubmissionstatement && (($assignment->cutoffdate != 0) && ($assignment->cutoffdate < time()))) {
					// Set data2 to submitted.
					$DB->set_field('assign_submission', 'status', 'submitted', array('id' => $document->submission));
					// Set status to 0 in document, so it can start sending.
					$DB->set_field('plagiarism_eph_document', 'status', '0', array('id' => $document->id));
					$DB->set_field('plagiarism_eph_document', 'guid', '', array('id' => $document->id));
				}
				continue;
			}
			$DB->set_field('plagiarism_eph_document', 'status', 99, array('id' => $document->id));
			$DB->set_field('plagiarism_eph_document', 'error', 'document_not_found', array('id' => $document->id));
		}
		unset($documents);
	}

	/**
	 * Function for getting the parameters needed for handing in a document to Ephorus.
	 *
	 * @param object $document - The document there the parameters are needed from
	 * @return array - Hand-in parameters bool - false
	 */
	public static function getHandinParameters($document) {
		global $DB, $CFG;

		$user_sql = 'SELECT * FROM {user} u
			LEFT JOIN {assign_submission} sub ON sub.userid = u.id
			WHERE sub.id = ?';
		$user = $DB->get_record_sql($user_sql, array($document->submission));

		$parameters = array();
		$parameters['code']          = self::getSetting('handin_code');
		$parameters['firstName']     = mb_substr($user->firstname, 0, 25, 'UTF-8');
		$parameters['middleName']    = '';
		$parameters['lastName']      = mb_substr($user->lastname, 0, 25, 'UTF-8');
		$parameters['studentEmail']  = mb_substr($user->email, 0, 75, 'UTF-8');
		$parameters['studentNumber'] = mb_substr((!empty($user->idnumber) ? $user->idnumber : $user->id), 0, 25, 'UTF-8');
		$parameters['comment']       = '';
		$parameters['fileName']      = $document->filename;
		$parameters['file']          = @file_get_contents($CFG->dataroot.'/filedir/'
			.substr($document->contenthash, 0, 2).'/'.substr($document->contenthash, 2, 2)
			.'/'.$document->contenthash);
		$parameters['processType']   = $document->processtype;

		return $parameters;
	}

	/**
	 * Function for getting the results for a Report
	 *
	 * @param string $document_guid - The guid from the document where you want results from.
	 * @return array
	 */
	public static function getResults($document_guid) {
		global $DB;

		$records = array();
		$results = $DB->get_records('plagiarism_eph_result', array('document_guid' => $document_guid), 'percentage DESC, id ASC');
		foreach($results as $result) {
			if($result->compressed == 1) {
				if(!extension_loaded('zlib')) {
					$result->comparison = '<document xmlns:ns2="http://reporting.ephorus.org/" xmlns="">Compressed report</document>';
					continue;
				}
				$result->comparison = gzuncompress(base64_decode($result->comparison));
			}
			$records[$result->guid] = $result;
		}
		return $records;
	}

	/**
	 * Function for getting the right (translated) text
	 * @param $identifier_string
	 * @return string
	 */
	public static function getText($identifier_string) {
		return get_string($identifier_string, 'plagiarism_ephorus');
	}

	/**
	 * Function to get the document information
	 *
	 * @param $document_guid
	 * @return stdClass
	 */
	public static function getDocument($document_guid) {
		global $DB;

		$document = $DB->get_record('plagiarism_eph_document', array('guid' => $document_guid));
		if($document != false && $document->compressed == 1) {
			if(!extension_loaded('zlib')) {
				$document->summary = '<document xmlns:ns2="http://reporting.ephorus.org/" xmlns="">Compressed report</document>';
			} else {
				$document->summary = gzuncompress(base64_decode($document->summary));
			}
		}
		return $document;
	}

	/**
	 * Function to get a formatted date
	 *
	 * @param $date
	 * @return string
	 */
	public static function formatDate($date) {
		return strftime('%A %d %B %Y', strtotime($date));
	}

	/**
	 * Function to get the url of a local document, a document known to the DLE
	 * This link will be shown in the report header, to allow easy access to the document
	 *
	 * @param $document_id
	 * @return string
	 */
	public static function getURL($document_id) {
		global $CFG, $DB;
		
		$file_id = $DB->get_field('plagiarism_eph_document', 'fileid', array('id' => $document_id));
		$fs = get_file_storage();
		$file = $fs->get_file_by_id($file_id);
		if(!$file) {
			return false;
		}
		return $CFG->wwwroot.'/pluginfile.php/'.$file->get_contextid().'/assignsubmission_file/submission_files'
			.$file->get_filepath().$file->get_itemid().'/'.rawurlencode($file->get_filename()).'?forcedownload=1';
	}

	/**
	 * Function to return a link with the document and a value for the anchor
	 * Shown by duplicate document report
	 *
	 * @param $document_id
	 * @return string
	 */
	public static function getLink($document_id) {
		global $DB;
		
		$document_name = $DB->get_field('plagiarism_eph_document', 'filename', array('id' => $document_id));

		return '<a href="'.self::getURL($document_id).'">'.$document_name.'</a>';
	}

	/**
	 * Function to return a link to the report of the selected document
	 * Shown by duplicate document report
	 *
	 * @param $document_guid
	 * @param $string
	 * @return string
	 */
	public static function getReportLink($document_guid, $string) {
		global $CFG;
		return '<a href="'.$CFG->wwwroot.'/plagiarism/ephorus/report.php?guid='.$document_guid.'">'.$string.'</a>';
	}

	/**
	 * Function to receive data from the DLE
	 *
	 * @return array
	 */
	public static function getDLEData() {
		self::initialize();

		global $CFG, $DB;
		return array(
			'dle'            => 'Moodle',
			'dle_version'    => $DB->get_field('config', 'value', array('name' => 'version')),
			'dle_release'    => $DB->get_field('config', 'value', array('name' => 'release')),
			'module_version' => get_config('plagiarism_ephorus')->version,
			'handin_address' => self::getSetting('handin_address'),
			'index_address'  => self::getSetting('index_address'),
		);
	}

	/**
	 * Function to check if a document exists in the database
	 *
	 * @param $document_guid
	 * @return bool|int - Returns false if not, document_id if does
	 */
	public static function checkDocumentExists($document_guid) {
		global $DB;
		return $DB->get_field('plagiarism_eph_document', 'id', array('guid' => $document_guid));
	}

	/**
	 * Function to set an error to a document e.g. wrong filetype
	 *
	 * @param int $document_id
	 * @param string $error
	 */
	public static function setHandinErrorToDocument($document_id, $error = '') {
		global $DB;

		$document = new stdClass();
		$document->id                 = $document_id;
		$document->status             = 99;
		$document->error              = $error;

		$DB->update_record('plagiarism_eph_document', $document);
	}

	/**
	 * Function to set a guid to a document
	 *
	 * @param $document_id
	 * @param $guid
	 */
	public static function setGUIDtoDocument($document_id, $document_guid) {
		global $DB;

		$DB->set_field('plagiarism_eph_document', 'guid', $document_guid, array('id' => $document_id));
	}

	/**
	 * Function to change the visibility index of a document
	 *
	 * @param $document_guid
	 * @param $visibility_index
	 */
	public static function changeVisibility($document_guid, $visibility_index) {
		global $DB;

		$DB->set_field('plagiarism_eph_document', 'visible', $visibility_index, array('guid' => $document_guid));
	}

	/**
	 * Function to update the document and save the report
	 *
	 * @param $document
	 * @param $results
	 */
	public static function saveReport($document, $results) {
		global $DB;

		$document->id = $DB->get_field('plagiarism_eph_document', 'id', array('guid' => $document->guid));
		if(extension_loaded('zlib')) {
			$document->summary = base64_encode(gzcompress($document->summary, 9));
			$document->compressed = 1;
		}
		$DB->update_record('plagiarism_eph_document', $document);

		$DB->delete_records('plagiarism_eph_result', array('document_guid' => $document->guid));

		foreach($results as $result) {
			if(extension_loaded('zlib')) {
				$result->comparison = base64_encode(gzcompress($result->comparison, 9));
				$result->compressed = 1;
			}
			$DB->insert_record('plagiarism_eph_result', $result, false);
		}
	}
}
