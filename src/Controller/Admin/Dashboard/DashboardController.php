<?php

namespace App\Controller\Admin\Dashboard;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController
{
    /**
     * @Route("/architect", name="adm_dashboard")
     */
    public function indexAction()
    {
        $user = $this->getUser();
        $user->getId();

        return $this->render('admin/dashboard.html.twig', array(
        ));
    }
}
