<?php

namespace App\Controller\Client\Security;

use App\Entity\Client\Utilisateur;
use \App\Form\Client\Security\Type\MailType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\Translation\TranslatorInterface;


/**
 * @Route("/client/e-mail")
 */
class EmailController extends AbstractController
{

    /**
     * @param User    $utilisateur
     *
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/", name="cli_modifier_email")
     */
    public function modifier(Request $request, TranslatorInterface $translator)
    {
        $utilisateur = $this->getUser();
        $editForm = $this->get('form.factory')->create(MailType::class, $utilisateur);

        if ($request->isMethod('POST') && $editForm->handleRequest($request)->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $message = $translator->trans('Email has been changed');
            $this->addFlash('notice', $message);

            return $this->redirectToRoute('cli_modifier_email');
        }

        return $this->render('client/profil/email.html.twig', array(
            'form' => $editForm->createView(),
            'user' => $utilisateur,
        ));
    }
}
