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
$string['pluginname']                   = 'Detección de plagios de Ephorus';
$string['ephorus']                      = 'Ephorus';
/* Settings page */
$string['saved_settings']               = 'Opciones de Ephorus guardada';
$string['ephorus_settings']             = 'Opciones de Ephorus';
$string['xsl_not_enabled']              = 'XSL extension is not enabled, this is required in order to show reports.'; //
$string['use_ephorus']                  = 'Activar Ephorus';
$string['ephorus_logging']              = 'Ephorus Logging'; //
$string['ephorus_logging_help']         = '<p>Ephorus Logging enables extra logging</p>'; //
$string['use_cron']                     = 'Use Ephorus in Moodle cron'; //
$string['use_cron_help']                = '<p>The hand-in script usually get called in the cron from Moodle, uncheck this to disable this feature.</p>
<p>You do however need to set a separate cronjob for the hand-in script.</p>'; //
$string['handin_code']                  = 'Código de entrega';
$string['handin_address']               = 'Dirección de entrega';
$string['index_address']                = 'Dirección de index';
$string['default_processtype']          = 'predeterminada tipo de proceso';
$string['default_processtype_help']     = '<p>Cuando se envía un documento a Ephorus, se debe elegir entre dos tipos de procesos.</p>
<ul>
    <li>Predeterminada: : los documentos que envíe se revisarán en busca de plagios y se usarán como material de referencia en el futuro. </li>
    <li>Privada: el documento se revisará en busca de plagios, pero no se usará como material de referencia.</li>
</ul>';
$string['student_disclosure']           = 'Revelación de estudiantes';
$string['student_disclosure_help']      = '<p>Este texto se mostrará a todos los estudiantes en la página de carga de archivos.</p>';
$string['default']                      = 'predeterminada';
$string['reference']                    = 'referencia';
$string['private']                      = 'privada';
$string['check_connection']             = 'Check connection'; //
$string['handin_index_okay']            = 'Hand-in and index address have got connection'; //
$string['handin_index_not_okay']        = 'Hand-in and index address haven\'t got connection'; //
$string['handin_okay']                  = 'Hand-in address has got connection'; //
$string['handin_not_okay']              = 'Hand-in address hasn\'t got connection'; //
$string['index_okay']                   = 'Index address has got connection'; //
$string['index_not_okay']               = 'Index address hasn\'t got connection'; //
/* Ephorus Lib */
$string['ephorus_status']               = 'Estado de Ephorus';
$string['send_document_manually']       = 'Send the file manually to Ephorus.'; //
$string['processtype']                  = 'Tipo de proceso';
$string['processtype_help']             = '<p>Cuando se envía un documento a Ephorus, se debe elegir entre 3 tipos de procesos.</p>
<ul>
    <li>Predeterminada: : los documentos que envíe se revisarán en busca de plagios y se usarán como material de referencia en el futuro. </li>
    <li>Referencia: el documento no se revisará en busca de plagios, pero se usará como material de referencia.</li>
    <li>Privada: el documento se revisará en busca de plagios, pero no se usará como material de referencia.</li>
</ul>';
/* Statuses */
$string['unfinalized_file']             = 'Archivo no finalizado';
$string['wait_for_sending']             = 'Intentando enviar archivo';
$string['wait_for_sending_msg']         = 'Waiting to send the Document to Ephorus.'; //
$string['processing']                   = 'Procesamiento en curso';
$string['processing_msg']               = 'Ephorus is scanning the document for possible plagiarism and the report will arrive shortly.'; //
$string['duplicate_document']           = 'Documento duplicado';
$string['duplicate_document_msg']       = 'Este documento se ha cargado previamente en Ephorus.';
$string['document_protected']           = 'Documento protegido';
$string['document_protected_msg']       = 'El documento está protegido por contraseña y no se ha podido examinar.';
$string['not_enough_text']              = 'No hay texto suficiente';
$string['not_enough_text_msg']          = 'El documento no contiene texto suficiente para una comprobación de plagios fiable.';
$string['no_text']                      = 'Sin texto';
$string['no_text_msg']                  = 'El documento no contiene texto y no se ha podido revisar en busca de plagios.';
$string['unknown_error']                = 'Error desconocido';
$string['unknown_error_msg']            = 'Se ha producido un error desconocido.';
$string['document_not_found']           = 'Documento no encontrado';
$string['document_not_found_msg']       = 'Ha accedido a esta página de forma incorrecta o el documento que busca no existe (ya).';
$string['unsupported_file_type']        = 'Este formato de archivo no es compatible.';
$string['unsupported_file_type_msg']    = 'Ephorus doesn\'t support this file type'; //
$string['unknown_file_error']           = 'Unable to send file'; //
$string['unknown_file_error_msg']       = 'Unable to send file'; //
/* Ephorus report */
$string['ephorus_report']               = 'Informe Ephorus';
$string['summary']                      = 'Resumen';
$string['detailed']                     = 'Detallado';
$string['document_information']         = 'Información del documento';
$string['student']                      = 'Estudiante';
$string['document']                     = 'Documento';
$string['submission_date']              = 'Fecha de presentación';
$string['total_score']                  = 'Coincidencia';
$string['document_written_by']          = 'Documento escrito por %s (%s)';
$string['update_sources']               = 'Update Sources'; //
$string['original_text']                = 'Presentación';
$string['found_by_ephorus']             = 'Se encuentra en otras fuentes';
$string['no_results_found']             = 'Sin similitudes';
$string['original_document_by']         = 'Documento original entregado por %s (%s) a %s';
$string['original_document_by_no_date'] = 'Documento original entregado por %s (%s)';
$string['duplicate_document_download']  = 'Descargar el documento';
$string['original_report']              = 'Informe original';
$string['link_original_report']         = 'Ver informe original';