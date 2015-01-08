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

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Tabela de Usuários
 *
 * @author LeandroSe <leandro@tsujiguchi.com.br>
 * @since 0.0.1
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="CustomTicket\Entity\UserRepository")
 */
class User implements UserInterface
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
     * Coluna Username.
     *
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=50)
     */
    private $username;

    /**
     * Coluna de Senha do Usuário.
     *
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=60)
     */
    private $password;

    /**
     * Coluna se o usuário esta ativo.
     *
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * Pegar regras do usuário.
     *
     * @var array
     *
     * @ORM\ManyToMany(targetEntity="Roles")
     * @ORM\JoinTable(name="user_roles",
     *                 joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *                 inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
     *                 )
     */
    private $roles;

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
     * Gets the Coluna Username.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Sets the Coluna Username.
     *
     * @param string $username the username
     *
     * @return self
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Gets the Coluna de Senha do Usuário.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Sets the Coluna de Senha do Usuário.
     *
     * @param string $password the password
     *
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Gets the Coluna se o usuário esta ativo.
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return (boolean) $this->isActive;
    }

    /**
     * Sets the Coluna se o usuário esta ativo.
     *
     * @param boolean $isActive the is active
     *
     * @return self
     */
    public function setIsActive($isActive)
    {
        $this->isActive = (boolean) $isActive;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRoles()
    {
        if ($this->roles->isEmpty()) {
            return [];
        } else {
            $arrRoles = [];
            foreach ($this->roles as $role) {
                $arrRoles[] = $role->getRole();
            }
            return $arrRoles;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getSalt()
    {
        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function eraseCredentials()
    {
    }

}
