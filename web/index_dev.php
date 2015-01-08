<?php

/**
 * CustomTicket 2015
 *
 * This file is part of CustomTicket.
 * CustomTicket is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * CustomTicket is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with CustomTicket.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author LeandroSe <leandro@tsujiguchi.com.br>
 * @since 0.0.1
 */

if (preg_match('/\.[a-z]{1,4}$/', $_SERVER["REQUEST_URI"])) {
    return false;
}

// DEV ERRROS
ini_set('display_errors', true);

// IS DEV
if (isset($_SERVER['HTTP_CLIENT_IP'])
    || isset($_SERVER['HTTP_X_FORWARDED_FOR'])
    || !(in_array(@$_SERVER['REMOTE_ADDR'], array('127.0.0.1', 'fe80::1', '::1')) || php_sapi_name() === 'cli-server')
) {
    header('HTTP/1.0 403 Forbidden');
    exit('Permissão negada. Não é permitido "desenvolvimento" em ambiente de produção.');
}

// AUTOLOADER
// require '../vendor/autoload.php';
$loader = require __DIR__ . '/../vendor/autoload.php';

// BOOTSTRAP
require __DIR__ . '/../app/config/parameters.php';
require __DIR__ . '/../app/bootstrap.php';

// CONFIG
require __DIR__ . '/../app/config/config_dev.php';

// DEBUG
$app['debug'] = true;

$app->run();
