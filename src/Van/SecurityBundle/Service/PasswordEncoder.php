<?php

namespace Van\SecurityBundle\Service;

use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

class PasswordEncoder implements PasswordEncoderInterface
{
    public function encodePassword($raw, $salt)
    {
        $salted = $salt . ':' . $raw;
        $hash = hash('sha1', $salted);

        return $hash;
    }

    public function isPasswordValid($encoded, $raw, $salt)
    {
        $isValid =  $encoded === $this->encodePassword($raw, $salt);

        return $isValid;
    }

}