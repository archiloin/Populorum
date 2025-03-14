<?php
namespace App\Security\Client;
 
use App\Entity\Client\Utilisateur as AppClient;
use Symfony\Component\Security\Core\Exception\AccountExpiredException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
 
class ConnexionChecker implements UserCheckerInterface
{
    public function checkPreAuth(UserInterface $user)
    {
        if (!$user instanceof AppClient) {
            return;
        }
    }
 
    public function checkPostAuth(UserInterface $user)
    {
        if (!$user instanceof AppClient) {
            return;
        }
 
        // user account is expired, the user may be notified
        if (!$user->getIsActive()) {
            throw new \Exception("ce membre n'est pas actif");
        }
    }
}