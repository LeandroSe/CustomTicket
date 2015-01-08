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
 * @package CustomTicket\Security\Encoder
 */
namespace CustomTicket\Security\Provider;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Doctrine\ORM\EntityManager;

/**
 * Classe para carregar informações do UserInterface para o sistema de autenticação.
 *
 * @author LeandroSe <leandro@tsujiguchi.com.br>
 * @since 0.0.1
 */
class UserProvider implements UserProviderInterface
{

    /**
     * Gerenciador de Entidade do Doctrine.
     * @var EntityManager
     */
    private $em;

    /**
     * Construtor.
     * @param EntityManager $em gerenciador de entidade do Doctrine
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByUsername($username)
    {
        $findUser = $this->em->getRepository('CustomTicket\Entity\User')->findLogin($username);
        if (!$findUser) {
            throw new UsernameNotFoundException(sprintf('Username "%s" does not exist.', $username));
        }
        return new User($findUser->getUsername(), $findUser->getPassword(), $findUser->getRoles(), true, true, true, true);
    }

    /**
     * {@inheritdoc}
     */
    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }
        return $this->loadUserByUsername($user->getUsername());
    }

    /**
     * {@inheritdoc}
     */
    public function supportsClass($class)
    {
        return $class === 'Symfony\Component\Security\Core\User\User';
    }

}
