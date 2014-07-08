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

/**
 * @package   plagiarism_ephorus
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/* Default texts for plugin */
$string['pluginname']                   = 'Ephorus Plagiaatpreventie';
$string['ephorus']                      = 'Ephorus';
/* Settings page */
$string['saved_settings']               = 'Ephorus instellingen opgeslagen';
$string['ephorus_settings']             = 'Ephorus instellingen';
$string['xsl_not_enabled']              = 'XSL extensie is niet ingeschakeld, dit is nodig om rapportages te laten zien.';
$string['use_ephorus']                  = 'Schakel Ephorus in';
$string['ephorus_logging']              = 'Ephorus Logging';
$string['ephorus_logging_help']         = '<p>Ephorus Logging verzorgd extra logging</p>';
$string['use_cron']                     = 'Gebruik Ephorus in Moodle cron';
$string['use_cron_help']                = '<p>Het inleverscript wordt standaard in de cron van Moodle opgeroepen, Vink dut uit om dit uit te zetten.</p>
<p>Je moet dan wel een extra cron regel moeten toevoegen voor het inleverscript.</p>';
$string['handin_code']                  = 'Inlevercode';
$string['handin_address']               = 'Inleveradres';
$string['index_address']                = 'Indexadres';
$string['default_processtype']          = 'Standaard verwerkingstype';
$string['default_processtype_help']     = '<p>Er zijn twee standaard opties om documenten naar Ephorus te versturen:</p>
<ul>
    <li>Standaard: De documenten worden gecontroleerd op plagiaat en gebruikt als referentiemateriaal in de toekomst.</li>
    <li>Privé: De documenten worden gecontroleerd op plagiaat en niet gebruikt als referentiemateriaal.</li>
</ul>';
$string['student_disclosure']           = 'Kennisgeving aan studenten';
$string['student_disclosure_help']      = '<p>Deze tekst zal weergegeven worden aan studenten op de uploadpagina.</p>';
$string['default']                      = 'Standaard';
$string['reference']                    = 'Referentie';
$string['private']                      = 'Privé';
$string['check_connection']             = 'Controleer connectie'; //
$string['handin_index_okay']            = 'Inlever en index adres hebben connectie';
$string['handin_index_not_okay']        = 'Inlever en index adres hebben geen connectie';
$string['handin_okay']                  = 'Inleveradres heeft connectie';
$string['handin_not_okay']              = 'Inleveradres heeft geen connectie';
$string['index_okay']                   = 'Indexadres heeft connectie';
$string['index_not_okay']               = 'Indexadres heeft geen connectie';
/* Ephorus Lib */
$string['ephorus_status']               = 'Ephorus status';
$string['send_document_manually']       = 'Stuur het bestand handmatig naar Ephorus.';
$string['processtype']                  = 'Verwerkingstype';
$string['processtype_help']             = '<p>Er zijn drie opties om documenten naar Ephorus te versturen:</p>
<ul>
    <li>Standaard: De documenten worden gecontroleerd op plagiaat en gebruikt als referentiemateriaal in de toekomst.</li>
    <li>Referentie: De documenten worden niet gecontroleerd op plagiaat maar wel gebruikt als referentiemateriaal in de toekomst.</li>
    <li>Privé: De documenten worden gecontroleerd op plagiaat en niet gebruikt als referentiemateriaal.</li>
</ul>';
/* Statuses */
$string['unfinalized_file']             = 'Bestand nog niet afgerond';
$string['wait_for_sending']             = 'Wacht op verzending';
$string['wait_for_sending_msg']         = 'Aan het wachten om het document naar Ephorus te versturen.';
$string['processing']                   = 'Verwerken';
$string['processing_msg']               = 'Ephorus is het document aan het controleren op plagiaat, er zal spoedig een rapportage binnenkomen.';
$string['duplicate_document']           = 'Duplicaat Document';
$string['duplicate_document_msg']       = 'Dit document is eerder ingeleverd.';
$string['document_protected']           = 'Beveiligd document';
$string['document_protected_msg']       = 'Het document is beveiligd met een wachtwoord en kan dus niet worden gecontroleerd.';
$string['not_enough_text']              = 'Niet genoeg tekst';
$string['not_enough_text_msg']          = 'Dit document bevat niet genoeg tekst voor een betrouwbare plagiaatscan.';
$string['no_text']                      = 'Geen tekst';
$string['no_text_msg']                  = 'Het document bevat geen tekst en kan niet worden gecontroleerd op plagiaat.';
$string['unknown_error']                = 'Onbekende fout';
$string['unknown_error_msg']            = 'Er is een onbekende fout opgetreden.';
$string['document_not_found']           = 'Document niet gevonden.';
$string['document_not_found_msg']       = 'Het document kon niet gevonden worden.';
$string['unsupported_file_type']        = 'Bestandstype niet ondersteund';
$string['unsupported_file_type_msg']    = 'Ephorus ondersteund dit bestandstype niet';
$string['unknown_file_error']           = 'Bestand kon niet verstuurd worden';
$string['unknown_file_error_msg']       = 'Bestand kon niet verstuurd worden';
/* Ephorus report */
$string['ephorus_report']               = 'Ephorus Rapportage';
$string['summary']                      = 'Samenvatting';
$string['detailed']                     = 'Gedetailleerd';
$string['document_information']         = 'Document Informatie';
$string['student']                      = 'Student';
$string['document']                     = 'Document';
$string['submission_date']              = 'Inleverdatum';
$string['total_score']                  = 'Totale Score';
$string['document_written_by']          = 'Document geschreven door %s (%s)';
$string['update_sources']               = 'Bronnen Bijwerken';
$string['original_text']                = 'Origineel';
$string['found_by_ephorus']             = 'Gevonden';
$string['no_results_found']             = 'Er zijn geen resultaten gevonden voor dit document.';
$string['original_document_by']         = 'Het Originele Document is ingeleverd door %s (%s) op %s';
$string['original_document_by_no_date'] = 'Het Originele Document is ingeleverd door %s (%s)';
$string['duplicate_document_download']  = 'Download het Document';
$string['original_report']              = 'Originele rapportage';
$string['link_original_report']         = 'bekijk originele rapportage';