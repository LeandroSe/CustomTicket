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
namespace CustomTicket\Security\Encoder;

use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\Encoder\BasePasswordEncoder;

/**
 * Gerador de Senha usando "password_hash".
 *
 * @author LeandroSe <leandro@tsujiguchi.com.br>
 * @since 0.0.1
 */
class MessageDigestPasswordEncoder extends BasePasswordEncoder
{

    /**
     * Algoritmo gerador da senha.
     * @var int
     */
    private $algorithm;

    /**
     * Options ao gerador de senha.
     * @var array
     */
    private $options = [];

    /**
     * Tipos válidos de geradores.
     *
     * Implementado até a versão 5.5 do PHP.
     * @var array
     */
    private $algorithms = [
        PASSWORD_BCRYPT,
        PASSWORD_DEFAULT
    ];

    /**
     * Construtor.
     *
     * @param int $algorithm algoritmo gerador de senha
     * @param int    $cost      custo de geração
     */
    public function __construct($algorithm = PASSWORD_BCRYPT, $cost = 11)
    {
        $this->algorithm = (int) $algorithm;
        $this->options['cost'] = $cost;
    }

    /**
     * {@inheritdoc}
     */
    public function encodePassword($raw, $salt)
    {
        if ($this->isPasswordTooLong($raw)) {
            throw new BadCredentialsException('Invalid password.');
        }

        if (!in_array($this->algorithm, $this->algorithms)) {
            throw new \LogicException(sprintf('The algorithm "%s" is not supported.', $this->algorithm));
        }

        $salted = $this->mergePasswordAndSalt($raw, $salt);
        $digest = password_hash($salted, $this->algorithm, $this->options);

        return $digest;
    }

    /**
     * {@inheritdoc}
     */
    public function isPasswordValid($encoded, $raw, $salt)
    {
        return !$this->isPasswordTooLong($raw) && password_verify($this->mergePasswordAndSalt($raw, $salt), $encoded);
    }

}

