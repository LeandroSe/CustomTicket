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
 * @package CustomTicket\Entity
 */
namespace CustomTicket\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Repositorio da entidade {@link User}.
 *
 * @author LeandroSe <leandro@tsujiguchi.com.br>
 * @since 0.0.1
 */
class UserRepository extends EntityRepository
{

    /**
     * Consultar informações do Login pelo nome do usuário, retorna informações das Regras.
     *
     * @param  string $username nome do usuário
     * @return User             instancia da classe
     */
    public function findLogin($username)
    {
        $dql = $this->getEntityManager()->createQuery(
            "SELECT u, r
             FROM CustomTicket\Entity\User u
             INNER JOIN u.roles r
             WHERE u.username = :username");
        $dql->setParameter('username', $username);
        return $dql->getSingleResult();
    }

}
