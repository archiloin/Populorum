<?php

namespace App\Controller\Client\Notification;

use App\Entity\Client\Notification\Notification;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends AbstractController
{
    /**
     * @param Utilisateur    $user
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/client/notification/voir", name="cli_notification_voir")
     */
    public function index()
    {
        $user = $this->getUser();
        $idUser = $user->getId();

        $repository = $this->getDoctrine()->getRepository(Notification::class);
        $notifications = $repository->createQueryBuilder('n')
                        ->where('n.id = :id')
                        ->setParameter('id', $idUser)
                        ->orderBy('n.date', 'ASC')
                        ->getQuery()->getResult();

        return $this->render('client/notification/voir.html.twig', array(
            'notifications' => $notifications,
            'user' => $user,
        ));
    }
}
