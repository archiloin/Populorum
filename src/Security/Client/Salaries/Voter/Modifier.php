<?php

namespace App\Security\Client\Salaries\Voter;

use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use App\Entity\Client\Utilisateur;

class Modifier implements VoterInterface
{
    public function vote(TokenInterface $token, $subject, array $attributes)
    {
        if (!$subject instanceof \App\Entity\Client\Utilisateur) {
            return self::ACCESS_ABSTAIN;
        }

        if (!in_array('Modifier', $attributes)) {
            return self::ACCESS_ABSTAIN;
        }

        $user = $token->getUser();

        if (!$user instanceof Utilisateur) {
            return self::ACCESS_DENIED;
        }

        if ($user !== $subject->getClient()) {
            return self::ACCESS_DENIED;
        }

        return self::ACCESS_GRANTED;
    }
}
