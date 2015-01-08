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

require __DIR__ . '/config.php';

/////////////
// MONOLOG //
/////////////
$app->register(new Silex\Provider\MonologServiceProvider(), [
    'monolog.logfile' => __DIR__ . '/../../var/logs/prod.log',
    'monolog.level' => Monolog\Logger::WARNING,
    'monolog.name' => 'CustomTicket',
]);

///////////////////////////////////////
// TWIG GLOBAL VARIABLE, ENVIRONMENT //
///////////////////////////////////////
$app["twig"]->addGlobal("environment", "prod");
