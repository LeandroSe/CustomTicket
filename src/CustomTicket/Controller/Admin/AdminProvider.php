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
 * @package CustomTicket\Controller\Admin
 */
namespace CustomTicket\Controller\Admin;

/**
 * Provedor de registro de serviço e controller.
 *
 * @author LeandroSe <leandro@tsujiguchi.com.br>
 * @since  0.0.1
 */
class AdminProvider implements \Silex\ServiceProviderInterface, \Silex\ControllerProviderInterface {

    /**
     * {@inheritdoc}
     */
    public function boot(\Silex\Application $app)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function register(\Silex\Application $app)
    {
        $app["admin"] = $app->share(function() use ($app) {
            return new DefaultController();
        });
    }

    /**
     * {@inheritdoc}
     */
    public function connect(\Silex\Application $app)
    {
        $controller = $app["controllers_factory"];

        $controller->get('', 'admin:index')
            ->bind('admin');

        return $controller;
    }

}
