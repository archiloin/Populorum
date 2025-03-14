<?php

namespace App\Controller\Client\Core;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LogsController extends AbstractController
{
    /**
     * @Route("/client/mise_a_jour", name="cli_maj_logs")
     */
    public function majLogsAction()
    {
        return $this->render('client/core/maj-logs.html.twig');
    }
}