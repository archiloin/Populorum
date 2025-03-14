<?php

namespace App\Controller\Client\Security;

use App\Entity\Client\Utilisateur;
use \App\Form\Client\Security\Type\MdpType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Contracts\Translation\TranslatorInterface;


/**
 * @Route("/client/mot-de-passe")
 */
class MdpController extends AbstractController
{

    /**
     * @param User    $utilisateur
     *
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/client/modifier-mdp", name="cli_modifier_mdp")
     */
    public function modifier(Request $request, UserPasswordEncoderInterface $passwordEncoder, TranslatorInterface $translator)
    {
        $utilisateur = $this->getUser();
        $editForm = $this->get('form.factory')->create(MdpType::class, $utilisateur);

        if ($request->isMethod('POST') && $editForm->handleRequest($request)->isValid()) {


            // Encode le mot de passe
            $password = $passwordEncoder->encodePassword($utilisateur, $utilisateur->getPlainPassword());
            $utilisateur->setPassword($password);
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $message = $translator->trans('Password has been changed');
            $this->addFlash('notice', $message);

            return $this->redirectToRoute('cli_modifier_password');
        }

        return $this->render('client/profil/password.html.twig', array(
            'form' => $editForm->createView(),
            'user' => $utilisateur,
        ));
    }
}
