<?php

namespace App\Security;

use App\Entity\User;
use App\Entity\User as AppUser;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Exception\AccountExpiredException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class EnabledVoter extends Voter
{
    const ENABLED = 'enabled';

    protected function supports($attribute, $subject)
    {
        return $attribute === self::ENABLED && $subject instanceof UserInterface;
    }

    protected function voteOnAttribute($attribute, $user, TokenInterface $token)
    {
        return $user->isEnabled();
    }
}