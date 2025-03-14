<?php

namespace App\Controller\Client\Dashboard;

use App\Entity\Client\Utilisateur;
use App\Entity\Client\Skills\Skills;
use App\Entity\Admin\Vision\Alerte;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController
{

    /**
     * @Route("/client", name="cli_dashboard")
     */
    public function index()
    {
        $user = $this->getUser();
        $id = $user->getId();

        $skills = $this->getDoctrine()->getRepository(Skills::class)->findByIdSalarie($id);

        $salaries = $user->getSalaries();
        return $this->render('client/dashboard.html.twig', array(
            'salaries' => $salaries,
            'skills' => $skills,
        ));
    }

    /**
     * @Route("/client/dashboard/{id}", name="cli_dashboard_voir")
     */
    public function voir($id)
    {
        $user = $this->getUser();
        $idUser = $user->getId();

        $salaries = $user->getSalaries();
        $salarie = $this->getDoctrine()->getRepository(Utilisateur::class)->find($id);

        $skills = $this->getDoctrine()->getRepository(Skills::class)->findByIdSalarie($id);

        // Nécessaire à la sécurité, empêche la manipulation d'url
        if (!$this->isGranted('Voir', $salarie))
        {
              $alerte = new Alerte();
              $alerte->setUtilisateur($idUser);
              $alerte->setNiveau(2);
              $alerte->setType('Manipulation URL');
              $alerte->setIp($_SERVER['REMOTE_ADDR']);
              $alerte->setUserAgent($_SERVER['HTTP_USER_AGENT']);
              $alerte->setUrl($_SERVER['REQUEST_URI']);

              $em = $this->getDoctrine()->getManager();
              $em->persist($alerte);
              $em->flush();
              $entityManager = $this->getDoctrine()->getManager();
              $entityManager->flush();

              return $this->render('vision/bannissement/police.html.twig');
        }

        return $this->render('client/dashboard.html.twig', array(
            'salarie' => $salarie,
            'salaries' => $salaries,
            'skills' => $skills,
        ));
    }
}
