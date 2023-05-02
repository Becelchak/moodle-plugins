<?php
// This file is part of Moodle - https://moodle.org/
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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * webgl module language file
 *
 * @package mod_webgl
 * @copyright  2020 Brain station 23 ltd <>  {@link https://brainstation-23.com/}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['modulename'] = 'WebGL';
$string['modulenameplural'] = 'WebGL';
$string['modulename_help'] = 'WebGL - это JavaScript API для рендеринга интерактивной 2D и 3D графики в любом совместимом веб-браузере без использования плагинов. WebGL полностью интегрирован с другими веб-стандартами, позволяя использовать физику, обработку изображений и эффекты с ускорением GPU как часть холста веб-страницы.';
$string['contentheader'] = 'Содержимое';
$string['input:file'] = 'WebGL файл';
$string['header:content'] = 'WebGL содержимое';
$string['webgl:addinstance'] = 'Добавьте новое приложение WebGL.';
$string['webgl:submit'] = 'Отправить приложение WebGL';
$string['webgl:view'] = 'Просмотр webGL';
$string['nowebgls'] = 'Записи webgl в этом курсе не найдены.';
$string['appstreamfieldset'] = 'Пользовательский пример набора полей';
$string['appstreamname'] = 'WebGL название';
$string['appstreamname_help'] = 'Это содержимое всплывающей подсказки, связанной с полем appstreamname. Поддерживается синтаксис Markdown.';
$string['webgl'] = 'webgl';
$string['pluginadministration'] = 'webgl администратор';
$string['pluginname'] = 'webgl';
$string['ziparchive'] = 'Выберите zip-файл.';
$string['ziparchive_help'] = 'Выберите zip-файл, содержащий файлы и папки index.html, index.liquid, logo, .htaccess и build.';

$string['content_advcheckbox'] = 'Обновляйте также содержимое WebGL';
$string['content_advcheckbox_help'] = 'Если включено, вы также можете обновить содержимое WebGL';

$string['download_exception'] = 'Вы должны указать идентификатор курса_модуля или идентификатор экземпляра';

// BEGIN: Fields in the admin form.

$string['storage_engine'] = 'Место хранения';
$string['storage_engine_help'] = 'Механизм хранения данных: Webgl предоставляет единственное хранилище - файловую систему Moodle, которая и стоит по умолчанию.';

$string['store_zip_file'] = 'Загрузить zip-файл';

$string['iframe_height'] = 'Высота содержимого';
$string['iframe_height_help'] = 'Высота Iframe, загружающего WebGL-контент, в (пикселях, (r)em, процентах). Значение по умолчанию - 550px.';

$string['iframe_width'] = 'Ширина содержимого';
$string['iframe_width_help'] = 'Ширина Iframe, загружающего WebGL-контент, в (пикселях, (r)em, процентах). Значение по умолчанию - 100%.';
$moduleintro = get_string('moduleintro');

$string['before_description'] = 'Показать содержимое WebGL перед разделом' . $moduleintro . '.';
$string['before_description_help'] = 'По умолчанию содержимое WebGL будет отображаться после раздела' . $moduleintro . '. Установите флажок Если вы хотите показать содержимое перед разделом' . $moduleintro . ' .';

$string['storage'] = 'Детали хранения';
$string['local_file_system'] = 'Файловая система Moodle';

$string['privacy:metadata'] = 'Плагин mod_webgl не хранит никаких личных данных.';
$string['previously_uploaded'] = 'Имя ранее загруженного файла :';

// END: Fields in the admin form.
