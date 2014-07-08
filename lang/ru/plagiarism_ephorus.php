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
$string['pluginname']                   = 'Система обнаружения плагиата Ephorus';
$string['ephorus']                      = 'Ephorus';
/* Settings page */
$string['saved_settings']               = 'Настройки Ephorus сохранены';
$string['ephorus_settings']             = 'Настройки Ephorus';
$string['xsl_not_enabled']              = 'XSL расширением не включена, это требуется для того, чтобы показать отчетов.';
$string['use_ephorus']                  = 'Активировать Ephorus';
$string['ephorus_logging']              = 'Ephorus Logging'; //
$string['ephorus_logging_help']         = '<p>Ephorus Logging enables extra logging</p>'; //
$string['use_cron']                     = 'Use Ephorus in Moodle cron'; //
$string['use_cron_help']                = '<p>The hand-in script usually get called in the cron from Moodle, uncheck this to disable this feature.</p>
<p>You do however need to set a separate cronjob for the hand-in script.</p>'; //
$string['handin_code']                  = 'Код подачи';
$string['handin_address']               = 'Адрес подачи';
$string['index_address']                = 'Адрес указателя';
$string['default_processtype']          = 'Тип обработки';
$string['default_processtype_help']     = '<p>При отправке документа в систему Ephorus следует выбрать один из cтандартная двух типов обработки.</p>
<ul>
    <li>Стандартный: документы проходят проверку на плагиат и будут использованы в качестве справочного материала в будущем. </li>
    <li>Конфиденциальная: ваши документы проходят проверку на плагиат, но не будут использованы в качестве справочного материала.</li>
</ul>';
$string['student_disclosure']           = 'Предоставление информации о студенте';
$string['student_disclosure_help']      = '<p>Этот текст будет показан всем студентам на странице загрузки файла.</p>';
$string['default']                      = 'Стандартная';
$string['reference']                    = 'Справочный';
$string['private']                      = 'Конфиденциальная';
$string['check_connection']             = 'Check connection'; //
$string['handin_index_okay']            = 'Hand-in and index address have got connection'; //
$string['handin_index_not_okay']        = 'Hand-in and index address haven\'t got connection'; //
$string['handin_okay']                  = 'Hand-in address has got connection'; //
$string['handin_not_okay']              = 'Hand-in address hasn\'t got connection'; //
$string['index_okay']                   = 'Index address has got connection'; //
$string['index_not_okay']               = 'Index address hasn\'t got connection'; //
/* Ephorus Lib */
$string['ephorus_status']               = 'Статус Ephorus';
$string['send_document_manually']       = 'Отправьте файл вручно к Ephorus.';
$string['processtype']                  = 'Тип обработки';
$string['processtype_help']             = '<p>При отправке документа в систему Ephorus следует выбрать один из трех типов обработки.</p>
<ul>
    <li>Стандартный: документы проходят проверку на плагиат и будут использованы в качестве справочного материала в будущем. </li>
    <li>Справочный материал: документы не проходят проверку на плагиат, но будут использованы в качестве справочного материала.</li>
    <li>Конфиденциальная: ваши документы проходят проверку на плагиат, но не будут использованы в качестве справочного материала.</li>
</ul>';
/* Statuses */
$string['unfinalized_file']             = 'Незавершенный файл';
$string['wait_for_sending']             = 'Попытка отправить файл';
$string['wait_for_sending_msg']         = 'Waiting to send the Document to Ephorus.'; //
$string['processing']                   = 'Обработка';
$string['processing_msg']               = 'Ephorus is scanning the document for possible plagiarism and the report will arrive shortly.'; //
$string['duplicate_document']           = 'Дубликат документа';
$string['duplicate_document_msg']       = 'Данный документ уже был загружен в систему Ephorus раньше.';
$string['document_protected']           = 'Защищенный документ';
$string['document_protected_msg']       = 'Документ защищен паролем и не может быть проанализирован.';
$string['not_enough_text']              = 'Недостаточно текста';
$string['not_enough_text_msg']          = 'В документе недостаточно текста для проведения достоверной проверки на предмет плагиата.';
$string['no_text']                      = 'Текст отсутствует';
$string['no_text_msg']                  = 'В документе не содержится текст, поэтому проверка на плагиат невозможна.';
$string['unknown_error']                = 'Неизвестная ошибка';
$string['unknown_error_msg']            = 'Произошла неизвестная ошибка.';
$string['document_not_found']           = 'Документ не найден';
$string['document_not_found_msg']       = 'Либо вы попали на данную страницу неправильным путем, либо искомый документ (больше) не существует.';
$string['unsupported_file_type']        = 'тип файла не поддерживаетс';
$string['unsupported_file_type_msg']    = 'тип файла не поддерживаетс';
$string['unknown_file_error']           = 'Невозможно отправить файл';
$string['unknown_file_error_msg']       = 'Невозможно отправить файл';
/* Ephorus report */
$string['ephorus_report']               = 'Ephorus Отчет';
$string['summary']                      = 'Краткий';
$string['detailed']                     = 'Подробный';
$string['document_information']         = 'Информация о документе';
$string['student']                      = 'Студент';
$string['document']                     = 'Документ';
$string['submission_date']              = 'Дата подачи';
$string['total_score']                  = 'Совпадение';
$string['document_written_by']          = 'документ написан %s (%s)';
$string['update_sources']               = 'Update Sources'; //
$string['original_text']                = 'Подача документов студентом';
$string['found_by_ephorus']             = 'Найдено в других источниках';
$string['no_results_found']             = 'Невозможно найти сходство.';
$string['original_document_by']         = 'Исходный документ подан %s (%s) on %s';
$string['original_document_by_no_date'] = 'Исходный документ подан %s (%s)';
$string['duplicate_document_download']  = 'Загрузить файл';
$string['original_report']              = 'Исходный отчет';
$string['link_original_report']         = 'Просмотреть исходный отчетt';