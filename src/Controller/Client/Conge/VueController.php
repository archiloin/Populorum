<?php

namespace App\Controller\Client\Conge;

use App\Entity\Client\Conge\Absence;
use App\Form\Client\Conge\Type\ModifierType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @Route("/client/conges")
 */
class VueController extends AbstractController
{
    /**
     * @Route("/", name="cli_conges", methods={"GET","POST"})
     */
    public function index(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_GESTIONNAIRE');
        $user = $this->getUser();
        $salaries = $user->getSalaries();

        return $this->render('client/conge/vue.html.twig', [
            'salaries' => $salaries,
        ]);
    }

    /**
     * @Route("/gestion/{id}", name="cli_conges_gestion", methods={"GET","POST"})
     */
    public function gestion(Request $request, $id, TranslatorInterface $translator): Response
    {
        $this->denyAccessUnlessGranted('ROLE_GESTIONNAIRE');
        $user = $this->getUser();
        $salaries = $user->getSalaries();

        $conges = $this->getDoctrine()->getRepository(Absence::class)->find($id);
        $form = $this->createForm(ModifierType::class, $conges);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $message = $translator->trans('The leave request has been correctly processed');
            $this->addFlash('success', $message);

            return $this->redirectToRoute('cli_conges');
        }
        return $this->render('client/conge/gestion.html.twig', [
            'conges' => $conges,
            'form' => $form->createView(),
        ]);
    }
}
