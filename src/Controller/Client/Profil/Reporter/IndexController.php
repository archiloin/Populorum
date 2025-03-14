<?php

namespace App\Controller\Client\Profil\Reporter;

use App\Entity\Client\Utilisateur;
use App\Form\Client\Profil\Type\ProfilType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @Route("/client/profil")
 */
class IndexController extends AbstractController
{

    /**
     * @param Utilisateur    $user
     *
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/reporter", name="cli_profil_reporter")
     */
    public function voir()
    {
        $user = $this->getUser();
        $user->getId();
        $profil = $user->getProfil();

        return $this->render('client/profil/reporter/voir.html.twig', array(
            'profil' => $profil,
            'user' => $user,
        ));
    }

    /**
     * @param Utilisateur    $user
     * @param Request $request
     *
     * @Method({"GET", "POST"})
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/modifier-reporter", name="cli_profil_modifier_reporter")
     */
    public function modifier(Request $request, TranslatorInterface $translator)
    {
        $user = $this->getUser();
        $user->getId();
        $profil = $user->getProfil();


        $editForm = $this->get('form.factory')->create(ProfilType::class, $profil);

        if ($request->isMethod('POST') && $editForm->handleRequest($request)->isValid()) {
            $profil->setDateProfilUpdate(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $message = $translator->trans('Profile saved');
            $this->addFlash('notice', $message);

            return $this->redirectToRoute('cli_voir_profil');
        }

        return $this->render('client/profil/reporter/modifier.html.twig', array(
            'form' => $editForm->createView(),
            'user' => $user,
            'profil' => $profil,
        ));
    }

}
