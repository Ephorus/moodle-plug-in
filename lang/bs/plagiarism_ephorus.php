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
$string['pluginname']                   = 'Ephorus otkrivanje plagijata';
$string['ephorus']                      = 'Ephorus';
/* Settings page */
$string['saved_settings']               = 'Ephorus postavke sačuvana';
$string['ephorus_settings']             = 'Ephorus postavke';
$string['xsl_not_enabled']              = 'Za prikazivanje izevjestaja, neophodno je omoguciti XLS ekstenziju.';
$string['use_ephorus']                  = 'Omogući Ephorus';
$string['ephorus_logging']              = 'Ephorus Logging';
$string['ephorus_logging_help']         = '<p>Ephorus Logging omogucava dodatno logging</p>';
$string['use_cron']                     = 'Use Ephorus in Moodle cron'; //
$string['use_cron_help']                = '<p>The hand-in script usually get called in the cron from Moodle, uncheck this to disable this feature.</p>
<p>You dou however need to set a separate cronjob for the hand-in script.</p>'; //
$string['handin_code']                  = 'Šifra za predaju radova';
$string['handin_address']               = 'Adresa za predaju radova';
$string['index_address']                = 'Adresa za indeksiranje';
$string['default_processtype']          = 'Default Vrsta postupka';
$string['default_processtype_help']     = '<p>Prilikom slanja dokumenta Ephorusu, potrebno je napraviti odabir između 2 vrste postupaka.</p>
<ul>
    <li>Uobičajeni: Dokumenti koje pošaljete će biti provjereni radi mogućnosti postojanja plagijata i biće korišteni kao referentni materijal u budućnosti.</li>
    <li>Privatni: Vaš dokument će biti provjeren radi mogućnosti postojanja plagijata, ali neće biti korišten kao referentni materijal.</li>
</ul>';
$string['student_disclosure']           = 'Otkrivanje podataka o učeniku';
$string['student_disclosure_help']      = '<p>Ovaj tekst će biti prikazan svim učenicima na stranici za učitavanje datoteka.</p>';
$string['default']                      = 'Uobičajeni';
$string['reference']                    = 'Referentni';
$string['private']                      = 'Privatni';
$string['check_connection']             = 'Check connection'; //
$string['handin_index_okay']            = 'Hand-in and index address have got connection'; //
$string['handin_index_not_okay']        = 'Hand-in and index address haven\'t got connection'; //
$string['handin_okay']                  = 'Hand-in address has got connection'; //
$string['handin_not_okay']              = 'Hand-in address hasn\'t got connection'; //
$string['index_okay']                   = 'Index address has got connection'; //
$string['index_not_okay']               = 'Index address hasn\'t got connection'; //
/* Ephorus Lib */
$string['ephorus_status']               = 'Ephorus status';
$string['send_document_manually']       = 'Posalji document manuelno na Ephorus.';
$string['processtype']                  = 'Vrsta postupka';
$string['processtype_help']             = '<p>Prilikom slanja dokumenta Ephorusu, potrebno je napraviti odabir između 3 vrste postupaka.</p>
<ul>
    <li>Uobičajeni: Dokumenti koje pošaljete će biti provjereni radi mogućnosti postojanja plagijata i biće korišteni kao referentni materijal u budućnosti. </li>
    <li>Referentni: Dokument neće biti provjeren radi mogućnosti postojanja plagijata, ali će biti korišten kao referentni materijal.</li>
    <li>Privatni: Vaš dokument će biti provjeren radi mogućnosti postojanja plagijata, ali neće biti korišten kao referentni materijal.</li>
</ul>';
/* Statuses */
$string['unfinalized_file']             = 'Nefinalizirana datoteka';
$string['wait_for_sending']             = 'Pokušavanje slanja datoteke';
$string['wait_for_sending_msg']         = 'Pokušavanje slanja datoteke';
$string['processing']                   = 'Obrada u toku';
$string['processing_description']       = 'Ephorus još ne obrađuje dokument. Pokušajte ponovno kasnije.';
$string['duplicate_document']           = 'Duplikat dokumenta';
$string['duplicate_document_msg']       = 'Ovaj dokument je ranije učitan Ephorusu.';
$string['document_protected']           = 'Zaštićen dokument';
$string['document_protected_msg']       = 'Dokument je zaštićen lozinkom i nije mogao biti pregledan.';
$string['not_enough_text']              = 'Nedovoljno teksta';
$string['not_enough_text_msg']          = 'Dokument ne sadrži dovoljno teksta za pouzdano pregledanje plagijata.';
$string['no_text']                      = 'Nema teksta';
$string['no_text_msg']                  = 'okument ne sadrži nikakav tekst i nije moglo biti provjereno postoji li plagijat.';
$string['unknown_error']                = 'Nepoznata greška';
$string['unknown_error_msg']            = 'Došlo je do nepoznate greške.';
$string['document_not_found']           = 'Document not found.';
$string['document_not_found_msg']       = 'The document could not be found.';
$string['unsupported_file_type']        = 'Unsupported file type';
$string['unsupported_file_type_msg']    = 'Ephorus doen\'t support this file type';
$string['unknown_file_error']           = 'Dokument nije poslan';
$string['unknown_file_error_msg']       = 'Dokument nije poslan';
/* Ephorus report */
$string['ephorus_report']               = 'Ephorus Izvještaj';
$string['summary']                      = 'Sažetak';
$string['detailed']                     = 'Detaljno';
$string['document_information']         = 'Informacije o dokumentu';
$string['student']                      = 'Učenik';
$string['document']                     = 'Dokument';
$string['submission_date']              = 'Datum predaje';
$string['total_score']                  = 'Podudarnost';
$string['document_written_by']          = 'Autor dokumenta %s (%s)';
$string['update_sources']               = 'Update Sources'; //
$string['original_text']                = 'Predaja od strane učenika';
$string['found_by_ephorus']             = 'Pronađeno u drugim izvorima';
$string['no_results_found']             = 'Nisu mogle biti pronađene nikakve sličnosti.';
$string['original_document_by']         = 'Originalni dokument je predat od %s (%s) %s';
$string['original_document_by_no_date'] = 'Originalni dokument je predat od %s (%s)';
$string['duplicate_document_download']  = 'Preuzmi datoteku';
$string['original_report']              = 'Originalni izvještaj';
$string['link_original_report']         = 'Pogledaj originalni izvještaj';