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

	public static function initialize()
	{

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
			case('ephorus_logging'):
				$return = '';
				break;
			case('handin_code'):
				$return = '';
				break;
			case('handin_address'):
				$return = '';
				break;
			case('index_address'):
				$return = '';
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
		switch ($setting) {
			case 'host':
				return '';
				break;
			case 'port':
				return '';
				break;
			case 'username':
				return '';
				break;
			case 'password':
				return '';
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
		$document = new stdClass();
		$document->id = (int) 1;
		$document->filename = '';
		$document->processtype = '';
		$document->user_id = (int) 1;

		return array(
			$document,
			$document,
			$document,
			$document,
		);
	}

	/**
	 * Function for getting the parameters needed for handing in a document to Ephorus.
	 *
	 * @param object $document - The document there the parameters are needed from
	 * @return array - Hand-in parameters bool - false
	 */
	public static function getHandinParameters($document) {
		$parameters = array();
		$parameters['code']          = self::getSetting('handin_code');
		$parameters['firstName']     = 'student_firstname';
		$parameters['middleName']    = 'student_middlename';
		$parameters['lastName']      = 'student_lastname';
		$parameters['studentEmail']  = 'student_email@school.com';
		$parameters['studentNumber'] = 'student_number';
		$parameters['comment']       = '';
		$parameters['fileName']      = $document->filename;
		$parameters['file']          = ''; // file content
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
		$result = new stdclass();
		$result->guid = '';             // The guid of the result
		$result->percentage = (int) 55; // 0-100
		$result->type = (string) '';    // internet / local
		$result->url = '';              // The url if type = internet
		$result->original_guid = '';    // The guid of the local document
		$result->student_name = '';     // Student name if type is local
		$result->student_number = '';   // Student number if type is local

		$result->comparison = '';       // The report

		return array(
			$result[$result->guid] = array(
				//etc...
			),
			$result[$result->guid],
			$result[$result->guid],
			$result[$result->guid],
		);
	}

	/**
	 * Function for getting the right (translated) text
	 * @param $identifier_string
	 * @return string
	 */
	public static function getText($identifier_string) {
		return (string) 'translated '.$identifier_string;
	}

	/**
	 * Function to get the document information
	 *
	 * @param $document_guid
	 * @return stdClass
	 */
	public static function getDocument($document_guid) {
		$document =  new stdClass();
		$document->id = (int) 1;
		$document->guid = (string) $document_guid;
		$document->status = (int) 0;
		$document->date_created = date('Y-m-d H:i:s');
		$document->summary = '';
		$document->original_guid = '';
		$document->original_student_name = '';
		$document->original_student_number = '';

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
		return 'location of the document with id = '.$document_id;
	}

	/**
	 * Function to return a link with the document and a value for the anchor
	 * Shown by duplicate document report
	 *
	 * @param $document_id
	 * @return string
	 */
	public static function getLink($document_id) {
		return '<a href="'.self::getLink($document_id).'">'.$document_name.'</a>';
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
		return '<a href="link to report?guid='.$document_guid.'">'.$string.'</a>';
	}

	/**
	 * Function to receive data from the DLE
	 *
	 * @return array
	 */
	public static function getDLEData() {
		return array(
			'dle' => '',
			'dle_version' => '',
			'dle_release' => '',
			'module_version' => '',
			'handin_address' => '',
			'index_address' => '',
		);
	}

	/**
	 * Function to check if a document exists in the database
	 *
	 * @param $document_guid
	 * @return bool|int - Returns false if not, document_id if does
	 */
	public static function checkDocumentExists($document_guid) {
		// e.g. SELECT id FROM document WHERE guid = $document_guid
		if($document_id) {
			return $document_id;
		}
		return false;
	}

	/**
	 * Function to set an error to a document e.g. wrong filetype
	 *
	 * @param int $document_id
	 * @param string $error
	 */
	public static function setHandinErrorToDocument($document_id, $error = '') {
		// e.g. UPDATE document SET status = 99, error = '$error' WHERE id = $document_id
	}

	/**
	 * Function to set a guid to a document
	 *
	 * @param $document_id
	 * @param $guid
	 */
	public static function setGUIDtoDocument($document_id, $guid) {
		// e.g. UPDATE document SET guid = '$guid' WHERE id = $document_id
	}

	/**
	 * Function to change the visibility index of a document
	 *
	 * @param $document_guid
	 * @param $visibility_index
	 */
	public static function changeVisibility($document_guid, $visibility_index) {
		// e.g. UPDATE document SET visibility_index = $visibility_index WHERE guid = $document_guid
	}

	/**
	 * Function to update the document and save the report
	 *
	 * @param $document
	 * @param $results
	 */
	public static function saveReport($document, $results) {
		// e.g. UPDATE document SET
		// status                  = $document->status,
		// profile                 = '$document->profile',
		// student_name            = 'addslashes($document->student_name)',
		// student_number          = 'addslashes($document->student_number)',
		// date_created            = '$document->date_created',
		// percentage              = $document->percentage,
		// summary                 = 'addslashes($document->summary)',
		// duplicate_guid          = '$document->duplicate_guid',
		// duplicate_studentname   = 'addslashes($document->duplicate_studentname)',
		// duplicate_studentnumber = 'addslashes($document->duplicate_studentnumber)'
		// WHERE guid = '$document->guid'

		// e.g. DELETE FROM results WHERE document_guid = '$document->guid'

		// For each result
		// INSERT INTO results (guid, document_guid, percentage, type, url, comparison
		//     original_guid, student_name, student_number) VALUES (
		//     '$result->guid', '$result->document_guid', '$result->percentage', '$result->type', 'addslashes($result->url)',
		//     'addslashes($result->comparison)', '$result->original_guid',
		//     'addslashes($result->student_name)', 'addslashes($result->student_number)')
	}
}
