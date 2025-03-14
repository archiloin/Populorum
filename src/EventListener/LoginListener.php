<?php
namespace App\EventListener;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class LoginListener
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $user = $event->getAuthenticationToken()->getUser();

        $user->setIp($_SERVER['REMOTE_ADDR']);
        $user->setUserAgent($_SERVER['HTTP_USER_AGENT']);
        $user->setLastLogin(new \DateTime());

        $this->em->persist($user);
        $this->em->flush();
    }
}
?>
