<?php

namespace App\Controller\Client\Support;

use App\Entity\Client\Utilisateur;
use App\Entity\Client\Support\Report;
use App\Form\Client\Support\Type\ReportType;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\Translation\TranslatorInterface;

class ReportController extends AbstractController
{
    /**
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/client/support/message", name="cli_report")
     */
    public function ReportAction(Request $request, TranslatorInterface $translator)
    {
        $user = $this->getUser();
        $id = $user->getId();

        $report = New Report;

        $utilisateur = $this->getDoctrine()->getRepository('App\Entity\Client\Utilisateur')->find($id);

        $form = $this->createForm(ReportType::class, $report);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $report->setUtilisateur($utilisateur);
            $em->persist($report);
            $em->flush();
            $message = $translator->trans('Your message has been sent');
            $this->addFlash('notice', $message);
            return $this->redirectToRoute('cli_report');
        }

        return $this->render('client/support/report.html.twig', array(
            'form' => $form->createView(),
            'user' => $user,
        ));
    }
}
