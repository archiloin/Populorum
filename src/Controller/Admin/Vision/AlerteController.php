<?php

namespace App\Controller\Admin\Vision;

use App\Entity\Admin\Vision\Alerte;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class AlerteController extends AbstractController
{
    /**
     * @param Utilisateur    $user
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/architect/vision/alerte", name="adm_alerte")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Alerte::class);
        $alertes = $repository->createQueryBuilder('a')
                        ->orderBy('a.date', 'ASC')
                        ->getQuery()->getResult();

        return $this->render('admin/vision/alerte.html.twig', array(
            'alertes' => $alertes,
        ));
    }
}
