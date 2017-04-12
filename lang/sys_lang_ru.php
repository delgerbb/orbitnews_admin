<?php

// +------------------------------------------------------------------------+
// | class.upload.ru_RU.php                                                 |
// +------------------------------------------------------------------------+
// | Copyright (c) Chup 2007. All rights reserved.                          |
// | Version       0.25                                                     |
// | Last modified 24/11/2007                                               |
// | Email         chupzzz@ya.ru                                            |
// +------------------------------------------------------------------------+
// | This program is free software; you can redistribute it and/or modify   |
// | it under the terms of the GNU General Public License version 2 as      |
// | published by the Free Software Foundation.                             |
// |                                                                        |
// | This program is distributed in the hope that it will be useful,        |
// | but WITHOUT ANY WARRANTY; without even the implied warranty of         |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the          |
// | GNU General Public License for more details.                           |
// |                                                                        |
// | You should have received a copy of the GNU General Public License      |
// | along with this program; if not, write to the                          |
// |   Free Software Foundation, Inc., 59 Temple Place, Suite 330,          |
// |   Boston, MA 02111-1307 USA                                            |
// |                                                                        |
// | Please give credit on sites that use class.upload and submit changes   |
// | of the script so other people can use them as well.                    |
// | This script is free to use, don't abuse.                               |
// +------------------------------------------------------------------------+
/**
 * Class upload Russian translation
 *
 * @version   0.25
 * @codepage  UTF-8 
 * @author    Chup (chupzzz@ya.ru)
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 * @copyright Free to change
 * @package   cmf
 * @subpackage external
 */
$sys_trans_lang = array();

//-------------------SL section head-------------------
$sys_trans_lang['cp_language_text'] = 'управление';

//-------------------SL section side menu-------------------
$sys_trans_lang['side_menu_system_text'] = 'Систем';
$sys_trans_lang['side_menu_news_text'] = 'Новости';
$sys_trans_lang['side_menu_company_text'] = 'Компания';
$sys_trans_lang['side_menu_gallery_video_text'] = 'Галерей и Видео';
$sys_trans_lang['side_menu_design_text'] = 'Мода';
$sys_trans_lang['side_menu_sales_text'] = 'Продаж';
$sys_trans_lang['side_menu_dashboard_text'] = 'При панель';
$sys_trans_lang['side_menu_hrd_text'] = 'отдел кадров';

//-------------------SL section side menu-------------------
$sys_trans_lang['your_access_denied_on_this_page'] = 'Ваш доступ запрещен на этой странице.';

//-------------------SL company news-------------------
$sys_trans_lang['action'] = 'действие';
$sys_trans_lang['picture'] = 'картина';
$sys_trans_lang['net_slug'] = 'NET адрес';
$sys_trans_lang['name'] = 'название';
$sys_trans_lang['code'] = 'код';
$sys_trans_lang['news'] = 'новости';

$sys_trans_lang['to_fix_the_company_old_news'] = 'чтобы исправить старые новости компании';
$sys_trans_lang['select_to_edit_news'] = 'Выбрать новости редактировать';

$sys_trans_lang['fix_news'] = 'Новости исправить';
$sys_trans_lang['add_news'] = 'Добавить новость';


$sys_trans_lang['file_error'] = 'Файловая ошибка. Попробуйте еще раз.';
$sys_trans_lang['local_file_missing'] = 'Локальный файл не существует.';
$sys_trans_lang['local_file_not_readable'] = 'Локальный файл закрыт для чтения.';
$sys_trans_lang['uploaded_too_big_ini'] = 'Ошибка загрузки файла (загруженный файл превышает лимит директивы the upload_max_filesize из php.ini).';
$sys_trans_lang['uploaded_too_big_html'] = 'Ошибка загрузки файла (загруженный файл превышает лимит директивы MAX_FILE_SIZE определенной в HTML-форме).';
$sys_trans_lang['uploaded_partial'] = 'Ошибка загрузки файла (файл загружен частично).';
$sys_trans_lang['uploaded_missing'] = 'Ошибка загрузки файла (файл не был загружен).';
$sys_trans_lang['uploaded_unknown'] = 'Ошибка загрузки файла (неизвестный код ошибки).';
$sys_trans_lang['try_again'] = 'Ошибка загрузки файла. Попробуйте еще раз.';
$sys_trans_lang['file_too_big'] = 'Файл очень большой.';
$sys_trans_lang['no_mime'] = 'Невозможно определить MIME-тип файла.';
$sys_trans_lang['incorrect_file'] = 'Некорректный тип файла.';
$sys_trans_lang['image_too_wide'] = 'Изображение очень широкое.';
$sys_trans_lang['image_too_narrow'] = 'Изображение очень узкое.';
$sys_trans_lang['image_too_high'] = 'Изображение очень высокое.';
$sys_trans_lang['image_too_short'] = 'Изображение очень короткое.';
$sys_trans_lang['ratio_too_high'] = 'Соотношение сторон очень велико (изображение очень широкое).';
$sys_trans_lang['ratio_too_low'] = 'Соотношение сторон очень мало (изображение очень высокое).';
$sys_trans_lang['too_many_pixels'] = 'В изображении очень много пикселей.';
$sys_trans_lang['not_enough_pixels'] = 'В изображении недостаточно пикселей.';
$sys_trans_lang['file_not_uploaded'] = 'Файл не загружен. Невозможно продолжить процесс.';
$sys_trans_lang['already_exists'] = '%s существует. Измените имя файла.';
$sys_trans_lang['temp_file_missing'] = 'Некорректный временый файл. Невозможно продолжить процесс.';
$sys_trans_lang['source_missing'] = 'Некорректный загруженный файл. Невозможно продолжить процесс.';
$sys_trans_lang['destination_dir'] = 'Директория назначения не может быть создана. Невозможно продолжить процесс.';
$sys_trans_lang['destination_dir_missing'] = 'Директория назначения не существует. Невозможно продолжить процесс.';
$sys_trans_lang['destination_path_not_dir'] = 'Путь назначения не является директорией. Невозможно продолжить процесс.';
$sys_trans_lang['destination_dir_write'] = 'Директория назначения закрыта для записи. Невозможно продолжить процесс.';
$sys_trans_lang['destination_path_write'] = 'Путь назначения закрыт для записи. Невозможно продолжить процесс.';
$sys_trans_lang['temp_file'] = 'Невозможно создать временный файл. Невозможно продолжить процесс.';
$sys_trans_lang['source_not_readable'] = 'Исходный файл нечитабельный. Невозможно продолжить процесс.';
$sys_trans_lang['no_create_support'] = 'Создание из %s не поддерживается.';
$sys_trans_lang['create_error'] = 'Ошибка создания %s изображения из оригинала.';
$sys_trans_lang['source_invalid'] = 'Невозможно прочитать исходный файл.';
$sys_trans_lang['gd_missing'] = 'Библиотека GD не обнаружена.';
$sys_trans_lang['watermark_no_create_support'] = '%s не поддерживается, невозможно прочесть водный знак.';
$sys_trans_lang['watermark_create_error'] = '%s не поддерживается чтение, невозможно создать водный знак.';
$sys_trans_lang['watermark_invalid'] = 'Неизвестный формат изображения, невозможно прочесть водный знак.';
$sys_trans_lang['file_create'] = '%s не поддерживается.';
$sys_trans_lang['no_conversion_type'] = 'Тип конверсии не указан.';
$sys_trans_lang['copy_failed'] = 'Ошибка копирования файла на сервер. Команда copy() выполнена с ошибкой.';
$sys_trans_lang['reading_failed'] = 'Ошибка чтения файла.';


?>