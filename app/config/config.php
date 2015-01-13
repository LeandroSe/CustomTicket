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

/////////////
// ROUTING //
/////////////
require __DIR__ . '/routing.php';

/////////////
// SESSION //
/////////////
$app->register(new Silex\Provider\SessionServiceProvider());

//////////
// TWIG //
//////////
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/../../src/CustomTicket/Resources/views',
));


///////////////////
// URL GENERATOR //
///////////////////
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

////////////////
// CONTROLLER //
////////////////
$app->register(new Silex\Provider\ServiceControllerServiceProvider());

///////////////////////////
// TWIG GLOBAL VARIABLES //
///////////////////////////
$app["twig"]->addGlobal("project_title", "CustomTicket");
$app["twig"]->addGlobal("project_separator", "|");

//////////////
// SECURITY //
//////////////
$security = $app->register(new Silex\Provider\SecurityServiceProvider(), [
    'security.firewalls' => array(
        'admin' => array(
            'pattern' => '^/admin/',
            'form' => array('login_path' => '/login', 'check_path' => '/admin/login_check'),
            'logout' => array('logout_path' => '/admin/logout'),
            'users' => $app->share(function() use ($em) {
                return new CustomTicket\Security\Provider\UserProvider($em);
            }),
            'remember_me' => [
                'key' => 'CustomTicketRandomRememberMe',
                'always_remember_me' => true,
                'lifetime' => (60 * 60 * 24 * 30)
            ],
        ),
    ),
    'security.role_hierarchy' => [
        'ROLE_SUPER_ADMIN' => ['ROLE_ADMIN'],
        'ROLE_ADMIN' => ['ROLE_USER']
    ],
    'security.encoder.digest' => $app->share(function ($app) {
        return new CustomTicket\Security\Encoder\MessageDigestPasswordEncoder();
    }),
    'security.access_rules' => [
        ['^/admin/login', 'IS_AUTHENTICATED_ANONYMOUSLY'],
        ['^/admin', 'ROLE_ADMIN'],
    ],
]);
$app->register(new Silex\Provider\RememberMeServiceProvider());
