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

use Doctrine\ORM\Mapping as ORM;

/**
 * Tabela de Usuários
 *
 * @author LeandroSe <leandro@tsujiguchi.com.br>
 * @since 0.0.1
 *
 * @ORM\Table(name="roles")
 * @ORM\Entity
 */
class Roles
{

    /**
     * Coluna ID.
     *
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Coluna Role.
     *
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=32)
     */
    private $role;

    /**
     * Gets the Coluna ID.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Gets the Coluna Role.
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Sets the Coluna Role.
     *
     * @param string $role the role
     *
     * @return self
     */
    private function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

}
