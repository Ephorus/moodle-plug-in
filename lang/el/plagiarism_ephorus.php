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
$string['pluginname']                   = 'Υπηρεσία ελέγχου Λογοκλοπής Ephorus';
$string['ephorus']                      = 'Ephorus';
/* Settings page */
$string['saved_settings']               = 'Οι ρυθμίσεις ελέγχου λογοκλοπής έχουν αποθηκευτεί';
$string['ephorus_settings']             = 'Ρυθμίσεις υπηρεσίας ελέγχου λογοκλοπής Ephorus';
$string['xsl_not_enabled']              = 'Η παράμετρος XSL δεν είναι ενεργή και απαιτείται για τη σωστή εμφάνιση των αναφορών.';
$string['use_ephorus']                  = 'Enable Ephorus'; //
$string['ephorus_logging']              = 'Ephorus Logging'; //
$string['ephorus_logging_help']         = '<p>Ephorus Logging enables extra logging</p>'; //
$string['use_cron']                     = 'Use Ephorus in Moodle cron'; //
$string['use_cron_help']                = '<p>The hand-in script usually get called in the cron from Moodle, uncheck this to disable this feature.</p>
<p>You dou however need to set a separate cronjob for the hand-in script.</p>'; //
$string['handin_code']                  = 'Hand-in code'; //
$string['handin_address']               = 'Hand-in address'; //
$string['index_address']                = 'Index address'; //
$string['default_processtype']          = 'Default Είδος ελέγχου';
$string['default_processtype_help']     = '<p>Όταν πραγματοποιείται έλεγχος λογοκλοπής, μπορείτε να επιλέξετε ανάμεσα σε 2 είδη ελέγχου.</p>
<ul>
    <li>Προεπιλογή: Τα αρχεία θα ελεγχθούν για λογοκλοπή και θα χρησιμοποιηθούν σαν αρχεία αναφοράς για μελλοντικούς ελέγχους.</li>
    <li>Αρχέιο Ιδιωτικό: Το αρχείο θα ελεγχθεί για λογοκλοπή αλλά ΔΕΝ θα χρησιμοποιηθεί σαν αρχείο αναφοράς για μελλοντικούς ελέγχους.</li>
</ul>';
$string['student_disclosure']           = 'Κείμενο αποδοχής για φοιτητή';
$string['student_disclosure_help']      = '<p>Αυτό το κείμενο θα εμφανίζεται σε όλους τους φοιτητές στην οθόνη αποστολής αρχείων.</p>';
$string['default']                      = 'Προεπιλογή';
$string['reference']                    = 'Αρχείο Αναφοράς';
$string['private']                      = 'Αρχείο Ιδιωτικό';
$string['check_connection']             = 'Check connection'; //
$string['handin_index_okay']            = 'Hand-in and index address have got connection'; //
$string['handin_index_not_okay']        = 'Hand-in and index address haven\'t got connection'; //
$string['handin_okay']                  = 'Hand-in address has got connection'; //
$string['handin_not_okay']              = 'Hand-in address hasn\'t got connection'; //
$string['index_okay']                   = 'Index address has got connection'; //
$string['index_not_okay']               = 'Index address hasn\'t got connection'; //
/* Ephorus Lib */
$string['ephorus_status']               = 'Ephorus status'; //
$string['send_document_manually']       = 'Μη αυτόματη αποστολή αρχείου για έλεγχο λογοκλοπής.';
$string['processtype']                  = 'Είδος ελέγχου';
$string['processtype_help']             = '<p>Όταν πραγματοποιείται έλεγχος λογοκλοπής, μπορείτε να επιλέξετε ανάμεσα σε 3 είδη ελέγχου.</p>
<ul>
    <li>Προεπιλογή: Τα αρχεία θα ελεγχθούν για λογοκλοπή και θα χρησιμοποιηθούν σαν αρχεία αναφοράς για μελλοντικούς ελέγχους.</li>
    <li>Αρχείο αναφοράς: Το αρχείο ΔΕΝ θα ελεγχθεί για λογοκλοπή αλλά θα χρησιμοποιηθεί σαν αρχείο αναφοράς για μελλοντικούς ελέγχους.</li>
    <li>Αρχέιο Ιδιωτικό: Το αρχείο θα ελεγχθεί για λογοκλοπή αλλά ΔΕΝ θα χρησιμοποιηθεί σαν αρχείο αναφοράς για μελλοντικούς ελέγχους.</li>
</ul>';
/* Statuses */
$string['unfinalized_file']             = 'Μη ολοκληρωμένο αρχείο';
$string['wait_for_sending']             = 'Wait for sending'; //
$string['wait_for_sending_msg']         = 'Waiting to send the Document to Ephorus.'; //
$string['processing']                   = 'Πραγματοποιείται έλεγχος';
$string['processing_msg']               = 'Το έγγραφο δεν έχει ελεγθεί για λογοκλοπή. Παρακαλώ δοκιμάστε αργότερα.';
$string['duplicate_document']           = 'Διπλότυπο Έγγραφο';
$string['duplicate_document_msg']       = 'Αυτό το έγγραφο έχει ελεγχθεί ξανά από την υπηρεσία ελέγχου Λογοκλοπής.';
$string['document_protected']           = 'Προστατευμένο έγγραφο';
$string['document_protected_msg']       = 'Το αρχείο προστατεύεται από κωδικό και δεν μπορεί να πραγματοποιηθεί έλεγχος λογοκλοπής';
$string['not_enough_text']              = 'Δεν περιέχει αρκετό κέιμενο';
$string['not_enough_text_msg']          = 'Αυτό το έγγραφο δεν περιέχει αρκετό κέιμενο για αξιόπιστο έλεγχο λογοκλοπής.';
$string['no_text']                      = 'Δεν περιέχει κείμενο';
$string['no_text_msg']                  = 'Αυτό το έγγραφο δεν περιέχει κέιμενο και δεν μπορέι να πραγματοποιηθεί έλεγχος λογοκλοπής.';
$string['unknown_error']                = 'Άγνωστο σφαλμα';
$string['unknown_error_msg']            = 'Παρουσιάστηκε άγνωστο σφάλμα.';
$string['document_not_found']           = 'Document not found';
$string['document_not_found_msg']       = 'This document has been handed in before.';
$string['unsupported_file_type']        = 'Μη υποστηριζόμενος τύπος αρχείου';
$string['unsupported_file_type_msg']    = 'Μη υποστηριζόμενος τύπος αρχείου';
$string['unknown_file_error']           = 'Αποτυχημένη προσπάθεια αποστολής αρχείου';
$string['unknown_file_error_msg']       = 'Αποτυχημένη προσπάθεια αποστολής αρχείου';
/* Ephorus report */
$string['ephorus_report']               = 'Ephorus Αναφορά';
$string['summary']                      = 'Περιληπτική';
$string['detailed']                     = 'Λεπτομερής';
$string['document_information']         = 'Πληροφορίες Εγγράφου';
$string['student']                      = 'Φοιτητής';
$string['document']                     = 'Έγγραφο';
$string['submission_date']              = 'Ημερομηνία Υποβολής';
$string['total_score']                  = 'Total Score'; //
$string['document_written_by']          = 'Document written by %s (%s)';
$string['update_sources']               = 'ανανέωση Πηγών';
$string['original_text']                = 'Original'; //
$string['found_by_ephorus']             = 'Found'; //
$string['no_results_found']             = 'Δεν εντοπιστηκε λογοκλοπή';
$string['original_document_by']         = 'Το προτότυπο έγγραφο υποβλήθηκε από το χρήστη %s (%s) on %s';
$string['original_document_by_no_date'] = 'Το προτότυπο έγγραφο υποβλήθηκε από το χρήστη %s (%s)';
$string['duplicate_document_download']  = 'Αποθήκευση αρχείου';
$string['original_report']              = 'Αναφορά ελέγχου λογοκλοπής';
$string['link_original_report']         = 'View original report'; //