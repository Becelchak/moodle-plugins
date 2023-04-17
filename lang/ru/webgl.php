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

$string['account_name'] = 'Имя учетной записи хранилища Azure';
$string['account_name_help'] = 'Учетная запись хранилища Azure содержит все ваши объекты данных Azure Storage: блобы, файлы, очереди, таблицы и диски. Учетная запись хранилища предоставляет уникальное пространство имен для ваших данных Azure Storage, доступное из любой точки мира по HTTP или HTTPS. Данные в учетной записи хранилища Azure являются долговечными и высокодоступными, безопасными и массово масштабируемыми.';
$string['account_key'] = 'Ключ учетной записи Azure Storage';
$string['account_key_help'] = 'При создании учетной записи хранилища Azure генерирует два 512-битных ключа доступа к учетной записи хранилища. Эти ключи можно использовать для авторизации доступа к данным в вашей учетной записи хранилища с помощью авторизации Shared Key.';
$string['container_name'] = 'Контейнер для хранения блобов';
$string['container_name_help'] = 'Azure Blob Storage помогает создавать озера данных для аналитических задач и обеспечивает хранение данных для создания мощных облачных и мобильных приложений. Оптимизируйте расходы с помощью многоуровневого хранилища для долгосрочных данных и гибко масштабируйте его для высокопроизводительных вычислений и рабочих нагрузок машинного обучения.';
$string['access_key'] = 'Ключ доступа AWS';
$string['access_key_help'] = 'Ключ доступа AWS';

$string['secret_key'] = 'Секретный_ключ AWS';
$string['secret_key_help'] = 'Секретный_ключ AWS';

$string['storage_engine'] = 'Двигатель хранения';
$string['storage_engine_help'] = 'Механизм хранения данных: Webgl предоставляет 3 вида хранилищ. Файловая система по умолчанию Moodle, BLOB-хранилище Azure, AWS S3. Выберите подходящее';

$string['account_name_error'] = 'Имя учетной записи не должно быть пустым, если движком хранения является Azure BLOB storage.';
$string['account_key_error'] = 'Ключ учетной записи не должен быть пустым, если движком хранения является Azure BLOB storage.';
$string['container_name_error'] = 'Имя контейнера не должно быть пустым, если механизмом хранения является Azure BLOB storage.';

$string['access_key_error'] = 'Ключ доступа не должен быть пустым, если механизмом хранения является AWS s3.';
$string['secret_key_error'] = 'Секретный ключ не должен быть пустым, если механизмом хранения является AWS s3.';
$string['endpoint_error'] = 'Конечная точка не должна быть пустой, пока механизмом хранения является AWS s3.';

$string['endpoint'] = 'Конечная точка S3';
$string['endpoint_help'] = 'Конечная точка AWS s3';

$string['bucket_name'] = 'Имя ведра AWS S3';
$string['bucket_name_help'] = 'Имя ведра AWS s3 должно быть уникальным';

$string['cloudfront_url'] = 'URL-адрес Cloud Front';
$string['cloudfront_url_help'] = 'URL-адрес Cloud Front';

$string['store_zip_file'] = 'Загрузить zip-файл';
$string['store_zip_file_help'] = 'Также загрузите загруженный zip-файл в хранилище Azure Blob.';

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
