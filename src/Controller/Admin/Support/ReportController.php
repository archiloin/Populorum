<?php

namespace App\Controller\Admin\Support;

use App\Entity\Client\Support\Report;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ReportController extends AbstractController
{
    /**
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/architect/support/les-reports", name="adm_support_report")
     */
    public function ReportAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Report::class);
        $reports = $repository->findAll();

        return $this->render('admin/support/report.html.twig', array(
            'reports' => $reports,
        ));
    }
}
