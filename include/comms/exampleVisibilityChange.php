<?php

/**
 * indexdoxumentservice.php - Functions for indexing documents in Ephorus
 *
 * @package    Ephoruscomms
 * @subpackage Index Document Service
 * @author     Guido Bonnet
 * @copyright  2012 onwards Ephorus  {@link http://ephorus.com}
 */

include_once(dirname(__FILE__).'/class.EphorusApi.php');

$ephorus_service = new EphorusService();
$ephorus_service->visibilityService($document_guid, EphorusService::VISIBLE);