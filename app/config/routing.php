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

use Symfony\Component\HttpFoundation\Request;

///////////
// ADMIN //
///////////
$admin = $app['controllers_factory'];
$app->mount('/admin', $admin);

// "/admin"
$admin->get("/", function() {
    return "Admin";
});

////////////
// PUBLIC //
////////////
$public = $app['controllers_factory'];
$app->mount('/', $public);

// "/"
$public->get('/', function() {
    return 'Public';
});

// "/login"
$public->get('/login', function(Request $request) use ($app) {
    return $app['twig']->render('Admin/Login/index.twig', array(
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
    ));
});

/////////
// API //
/////////
$api = $app['controllers_factory'];
$app->mount('/api', $api);
