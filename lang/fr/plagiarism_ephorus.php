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
$string['pluginname']                   = 'Ephorus Plagiarism Prevention'; //
$string['ephorus']                      = 'Ephorus';
/* Settings page */
$string['saved_settings']               = 'Ephorus paramètres enregistrés';
$string['ephorus_settings']             = 'Ephorus paramètres';
$string['xsl_not_enabled']              = 'L\'extension XSL n\'est pas activée cela est nècessaire afin de montrer les rapports.';
$string['use_ephorus']                  = 'Active Ephorus';
$string['ephorus_logging']              = 'Ephorus Logging'; //
$string['ephorus_logging_help']         = '<p>Ephorus Logging enables extra logging</p>'; //
$string['use_cron']                     = 'Use Ephorus in Moodle cron'; //
$string['use_cron_help']                = '<p>The hand-in script usually get called in the cron from Moodle, uncheck this to disable this feature.</p>
<p>You do however need to set a separate cronjob for the hand-in script.</p>'; //
$string['handin_code']                  = 'Code de dépôt';
$string['handin_address']               = 'Adresse de dépôt';
$string['index_address']                = 'Adresse de l’indice';
$string['default_processtype']          = 'Type de traitement par défaut';
$string['default_processtype_help']     = '<p>En téléchargeant vos documents à Ephorus vous avez deux défaut options:</p>
<ul>
    <li>défaut: Votre document sera vérifié au niveau du plagiat éventuel et utilisé comme matériel de référence pour les vérifications ultérieures.</li>
    <li>privé: Votre document sera vérifié au niveau du plagiat éventuel mais ne sera pas utilisé comme matériel de référence pour les vérifications ultérieures.</li>
</ul>';
$string['student_disclosure']           = 'Texte pour l\'étudiant';
$string['student_disclosure_help']      = '<p>Ce texte sera affiché tous les édiants sur la page de téléchargement.</p>';
$string['default']                      = 'défaut';
$string['reference']                    = 'référence';
$string['private']                      = 'privé';
$string['check_connection']             = 'Check connection'; //
$string['handin_index_okay']            = 'Hand-in and index address have got connection'; //
$string['handin_index_not_okay']        = 'Hand-in and index address haven\'t got connection'; //
$string['handin_okay']                  = 'Hand-in address has got connection'; //
$string['handin_not_okay']              = 'Hand-in address hasn\'t got connection'; //
$string['index_okay']                   = 'Index address has got connection'; //
$string['index_not_okay']               = 'Index address hasn\'t got connection'; //
/* Ephorus Lib */
$string['ephorus_status']               = 'Statut d\'Ephorus';
$string['send_document_manually']       = 'Envoyer le document manuellement à Ephorus.';
$string['processtype']                  = 'Type de traitement'; //
$string['processtype_help']             = '<p>En téléchargeant vos documents à Ephorus vous avez deux défaut options:</p>
<ul>
    <li>défaut: Votre document sera vérifié au niveau du plagiat éventuel et utilisé comme matériel de référence pour les vérifications ultérieures.</li>
    <li>référence: Votre document ne sera pas vérifié au niveau du plagiat éventuel mais enregistré comme matériel de référence pour les vérifications ultérieures.</li>
    <li>privé: Votre document sera vérifié au niveau du plagiat éventuel mais ne sera pas utilisé comme matériel de référence pour les vérifications ultérieures.</li>
</ul>';
/* Statuses */
$string['unfinalized_file']             = 'Fichier pas finalise';
$string['wait_for_sending']             = 'En attente';
$string['wait_for_sending_msg']         = 'Waiting to send the Document to Ephorus.'; //
$string['processing']                   = 'Traitement';
$string['processing_msg']               = 'Le contrôle du plagiat est en cours et le rapport sera délivré dans les plus brefs délais.';
$string['duplicate_document']           = 'Dupliquer Document';
$string['duplicate_document_msg']       = 'Ce document a déjà été téléchargé.';
$string['document_protected']           = 'Document est protegé';
$string['document_protected_msg']       = 'Le document est protégépar un mot de passe Ephorus ne peut pas accéder au document.';
$string['not_enough_text']              = 'Pas suffisamment de texte';
$string['not_enough_text_msg']          = 'Votre document ne contient pas suffisamment de texte pour un contrôle de plagiat éventuel.';
$string['no_text']                      = 'Aucun texte';
$string['no_text_msg']                  = 'Ephorus ne peut vérifier que les textes pour un plagiat éventuel mais aucun texte n\'a été trouvé dans ce document.';
$string['unknown_error']                = 'Erreur inconnue';
$string['unknown_error_msg']            = 'Une erreur inconnue s’est produite et ce document n’a pas pu être contrôlé au niveau du plagiat.';
$string['document_not_found']           = 'Document n\'est pas trouvé';
$string['document_not_found_msg']       = 'The document could not be found.'; //
$string['unsupported_file_type']        = 'Ce format de fichier n’est pas supporté';
$string['unsupported_file_type_msg']    = 'Ephorus doesn\'t support this file type'; //
$string['unknown_file_error']           = 'Le document ne peut pas être envoyé';
$string['unknown_file_error_msg']       = 'Unable to send file'; //
/* Ephorus report */
$string['ephorus_report']               = 'Ephorus Report';
$string['summary']                      = 'Résumé';
$string['detailed']                     = 'Détaillé';
$string['document_information']         = 'Document envoyé';
$string['student']                      = 'Étudiant';
$string['document']                     = 'Document';
$string['submission_date']              = 'Devoir rendu';
$string['total_score']                  = 'Résultats Score';
$string['document_written_by']          = 'Document écrit par %s (%s)';
$string['update_sources']               = 'Update Sources'; //
$string['original_text']                = 'Envoyé';
$string['found_by_ephorus']             = 'Trouvé';
$string['no_results_found']             = 'Ephorus n’a pas trouvé de similitudes pour ce document.';
$string['original_document_by']         = 'The Original Document was handed in by %s (%s) on %s'; //
$string['original_document_by_no_date'] = 'The Original Document was handed in by %s (%s)'; //
$string['duplicate_document_download']  = 'Télécharger fichier';
$string['original_report']              = 'Original Report'; //
$string['link_original_report']         = 'View original report'; //