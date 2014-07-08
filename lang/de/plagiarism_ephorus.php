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
$string['pluginname']                   = 'Ephorus-Plagiaterkennung';
$string['ephorus']                      = 'Ephorus';
/* Settings page */
$string['saved_settings']               = 'Ephorus Einstellungen gespeichert';
$string['ephorus_settings']             = 'Ephorus Einstellungen';
$string['xsl_not_enabled']              = 'XSL Erweiterung ist nicht aktiviert, dass ist notwendig um die Berichte sehen zo können.';
$string['use_ephorus']                  = 'Ephorus aktivieren';
$string['ephorus_logging']              = 'Ephorus Logging'; //
$string['ephorus_logging_help']         = '<p>Ephorus Logging enables extra logging</p>'; //
$string['use_cron']                     = 'Use Ephorus in Moodle cron'; //
$string['use_cron_help']                = '<p>The hand-in script usually get called in the cron from Moodle, uncheck this to disable this feature.</p>
<p>You do however need to set a separate cronjob for the hand-in script.</p>'; //
$string['handin_code']                  = 'Einreichungscode';
$string['handin_address']               = 'Einreichungsadresse';
$string['index_address']                = 'Indexadresss';
$string['default_processtype']          = 'Standard Bearbeitungstyp';
$string['default_processtype_help']     = '<p>Beim Senden eines Dokuments an Ephorus sollte eine Auswahl aus zwei Bearbeitungstypen getroffen werden.</p>
<ul>
    <li>Standard: Die Dokumente, die Sie einsenden, werden auf Plagiate geprüft und in Zukunft als Referenzmaterial verwendet. </li>
    <li>Private: Das Dokument wird auf Plagiate geprüft, aber nicht als Referenzmaterial verwendet.</li>
</ul>';
$string['student_disclosure']           = 'Offenlegung an Schüler/Studenten';
$string['student_disclosure_help']      = '<p>Dieser Text wird auf der Datei-Upload-Seite allen Schülern/Studenten angezeigt.</p>';
$string['default']                      = 'Standard';
$string['reference']                    = 'Referenzmaterial';
$string['private']                      = 'Private';
$string['check_connection']             = 'Check connection'; //
$string['handin_index_okay']            = 'Hand-in and index address have got connection'; //
$string['handin_index_not_okay']        = 'Hand-in and index address haven\'t got connection'; //
$string['handin_okay']                  = 'Hand-in address has got connection'; //
$string['handin_not_okay']              = 'Hand-in address hasn\'t got connection'; //
$string['index_okay']                   = 'Index address has got connection'; //
$string['index_not_okay']               = 'Index address hasn\'t got connection'; //
/* Ephorus Lib */
$string['ephorus_status']               = 'Ephorus status';
$string['send_document_manually']       = 'Senden Sie das Dokument menuell an Ephorus.';
$string['processtype']                  = 'Bearbeitungstyp';
$string['processtype_help']             = '<p>Beim Senden eines Dokuments an Ephorus sollte eine Auswahl aus drei Bearbeitungstypen getroffen werden.</p>
<ul>
    <li>Standard: Die Dokumente, die Sie einsenden, werden auf Plagiate geprüft und in Zukunft als Referenzmaterial verwendet. </li>
    <li>Referenzmaterial: Das Dokument wird nicht auf Plagiate geprüft, sondern als Referenzmaterial verwendet.</li>
    <li>Private: Das Dokument wird auf Plagiate geprüft, aber nicht als Referenzmaterial verwendet.</li>
</ul>';
/* Statuses */
$string['unfinalized_file']             = 'Nicht fertiggestellte Datei';
$string['wait_for_sending']             = 'Warten auf Versenden';
$string['wait_for_sending_msg']         = 'Warten auf Versenden';
$string['processing']                   = 'Verarbeitung';
$string['processing_msg']               = 'Ephorus is scanning the document for possible plagiarism and the report will arrive shortly.';
$string['duplicate_document']           = 'Duplikat-Dokument';
$string['duplicate_document_msg']       = 'Dieses Dokument wurde schon einmal zu Ephorus hochgeladen.';
$string['document_protected']           = 'Geschütztes Dokument';
$string['document_protected_msg']       = 'The document is protected by a password and could not be scanned.';
$string['not_enough_text']              = 'Nicht genug Text';
$string['not_enough_text_msg']          = 'Das Dokument enthält nicht genügend Text, um eine zuverlässige Plagiatsprüfung durchführen zu können.';
$string['no_text']                      = 'Kein Text';
$string['no_text_msg']                  = 'Das Dokument enthält keinen Text und konnte nicht auf Plagiate geprüft werden.';
$string['unknown_error']                = 'Unbekannter Fehler';
$string['unknown_error_msg']            = 'Ein unbekannter Fehler ist aufgetreten.';
$string['document_not_found']           = 'Dokument nicht gefunden';
$string['document_not_found_msg']       = 'Sie haben diese Seite entweder irrtümlich aufgerufen oder das Dokument, das Sie suchen, ist nicht (mehr) vorhanden.';
$string['unsupported_file_type']        = 'Dateiformat nicht unterstützt';
$string['unsupported_file_type_msg']    = 'Dieses Dateiformat wird nicht unterstützt.';
$string['unknown_file_error']           = 'Das Dokument konnte nicht verschickt werden';
$string['unknown_file_error_msg']       = 'Das Dokument konnte nicht verschickt werden';
/* Ephorus report */
$string['ephorus_report']               = 'Ephorus Bericht';
$string['summary']                      = 'Zusammenfassung';
$string['detailed']                     = 'Detailliert';
$string['document_information']         = 'Dokumentinformationen';
$string['student']                      = 'Student';
$string['document']                     = 'Dokument';
$string['submission_date']              = 'Einreichungsdatum';
$string['total_score']                  = 'Übereinstimmung';
$string['document_written_by']          = 'Dokument geschrieben von %s (%s)';
$string['update_sources']               = 'Update Sources'; //
$string['original_text']                = 'Original';
$string['found_by_ephorus']             = 'In anderen Quellen gefunden';
$string['no_results_found']             = 'Es konnte keine Ähnlichkeiten gefunden werden.';
$string['original_document_by']         = 'Das Originaldokument wird eingereicht von %s (%s) am %s';
$string['original_document_by_no_date'] = 'Das Originaldokument wird eingereicht von %s (%s)';
$string['duplicate_document_download']  = 'Download the Document';
$string['original_report']              = 'Originalbericht';
$string['link_original_report']         = 'Originalbericht anzeigen';