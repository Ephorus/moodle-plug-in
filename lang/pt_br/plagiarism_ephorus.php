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
$string['pluginname']                   = 'Detecção de plágio Ephorus';
$string['ephorus']                      = 'Ephorus';
/* Settings page */
$string['saved_settings']               = 'Configurações de Ephorus salvas';
$string['ephorus_settings']             = 'Configurações de Ephorus salvas';
$string['xsl_not_enabled']              = 'XSL extension is not enabled, this is required in order to show reports.'; //
$string['use_ephorus']                  = 'Habilitar Ephorus';
$string['ephorus_logging']              = 'Ephorus Logging'; //
$string['ephorus_logging_help']         = '<p>Ephorus Logging enables extra logging</p>'; //
$string['use_cron']                     = 'Use Ephorus in Moodle cron'; //
$string['use_cron_help']                = '<p>The hand-in script usually get called in the cron from Moodle, uncheck this to disable this feature.</p>
<p>You do however need to set a separate cronjob for the hand-in script.</p>'; //
$string['handin_code']                  = 'Código de entrega';
$string['handin_address']               = 'Hand-in address'; //
$string['index_address']                = 'Index address'; //
$string['default_processtype']          = 'Predefinição Tipo de processo';
$string['default_processtype_help']     = '<p>Ao enviar um documento para o Ephorus, é preciso escolher uma opção entre 2 predefinição tipos de processo.</p>
<ul>
    <li>Predefinição: Os documentos que você enviar serão verificados quanto a plágio e serão usados como material de referência no futuro. </li>
    <li>Privado: O documento será verificado quanto a plágio, mas não\será usado como material de referência.</li>
</ul>';
$string['student_disclosure']           = 'Divulgação de estudantes';
$string['student_disclosure_help']      = '<p>Este texto será apresentado a todos os estudantes na página de carregamento do arquivo.</p>';
$string['default']                      = 'Predefinição';
$string['reference']                    = 'Referência';
$string['private']                      = 'Privado';
$string['check_connection']             = 'Check connection'; //
$string['handin_index_okay']            = 'Hand-in and index address have got connection'; //
$string['handin_index_not_okay']        = 'Hand-in and index address haven\'t got connection'; //
$string['handin_okay']                  = 'Hand-in address has got connection'; //
$string['handin_not_okay']              = 'Hand-in address hasn\'t got connection'; //
$string['index_okay']                   = 'Index address has got connection'; //
$string['index_not_okay']               = 'Index address hasn\'t got connection'; //
/* Ephorus Lib */
$string['ephorus_status']               = 'Status do Ephorus';
$string['send_document_manually']       = 'Send the file manually to Ephorus.'; //
$string['processtype']                  = 'Tipo de processo';
$string['processtype_help']             = '<p>Ao enviar um documento para o Ephorus, é preciso escolher uma opção entre 3 tipos de processo.</p>
<ul>
    <li>Predefinição: Os documentos que você enviar serão verificados quanto a plágio e serão usados como material de referência no futuro. </li>
    <li>Referência: O documento não\será verificado quanto a plágio, mas será usado como material de referência.</li>
    <li>Privado: O documento será verificado quanto a plágio, mas não\será usado como material de referência.</li>
</ul>';
/* Statuses */
$string['unfinalized_file']             = 'Arquivo não finalizado';
$string['wait_for_sending']             = 'Tentando enviar o arquivo';
$string['wait_for_sending_msg']         = 'Waiting to send the Document to Ephorus.'; //
$string['processing']                   = 'Processando';
$string['processing_msg']               = 'Ephorus is scanning the document for possible plagiarism and the report will arrive shortly.'; //
$string['duplicate_document']           = 'Documento duplicado';
$string['duplicate_document_msg']       = 'Esse documento foi carregado antes para o Ephorus.';
$string['document_protected']           = 'Documento protegido';
$string['document_protected_msg']       = 'O Documento está protegido por uma senha e não pode ser analisado.';
$string['not_enough_text']              = 'Sem texto suficiente';
$string['not_enough_text_msg']          = 'O documento não contém texto suficiente para uma análise confiável de plágio.';
$string['no_text']                      = 'Sem texto';
$string['no_text_msg']                  = 'O documento não contém qualquer texto e não pôde ser verificado quanto a plágio.';
$string['unknown_error']                = 'Erro desconhecido';
$string['unknown_error_msg']            = 'Ocorreu um erro desconhecido.';
$string['document_not_found']           = 'Documento não encontrado';
$string['document_not_found_msg']       = 'Ou você chegou a esta página de forma errada ou o documento que você está procurando não existe (já não existe).';
$string['unsupported_file_type']        = 'Este formato de ficheiro não é suportado';
$string['unsupported_file_type_msg']    = 'Ephorus doesn\'t support this file type'; //
$string['unknown_file_error']           = 'Unable to send file'; //
$string['unknown_file_error_msg']       = 'Unable to send file'; //
/* Ephorus report */
$string['ephorus_report']               = 'Ephorus Relatório';
$string['summary']                      = 'Resumo';
$string['detailed']                     = 'Detalhado';
$string['document_information']         = 'Informação de documento';
$string['student']                      = 'Estudantes';
$string['document']                     = 'Documento';
$string['submission_date']              = 'Data de envio';
$string['total_score']                  = 'Correspondência';
$string['document_written_by']          = 'Documento escrito por %s (%s)';
$string['update_sources']               = 'Update Sources'; //
$string['original_text']                = 'Envio de estudantes';
$string['found_by_ephorus']             = 'Encontrado em outras fontes';
$string['no_results_found']             = 'Não foram encontradas semelhanças.';
$string['original_document_by']         = 'O documento original é entregue por %s (%s) on %s';
$string['original_document_by_no_date'] = 'O documento original é entregue por %s (%s)';
$string['duplicate_document_download']  = 'Baixar o arquivo';
$string['original_report']              = 'Relatório original';
$string['link_original_report']         = 'Ver relatório original';