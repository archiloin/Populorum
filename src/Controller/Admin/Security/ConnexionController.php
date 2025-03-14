<?php

namespace App\Controller\Admin\Security;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;

class ConnexionController extends AbstractController
{
    /**
     * @Route("/architect/connexion", name="adm_connexion")
     */
    public function login(Request $request, AuthenticationUtils $authUtils)
    {
        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();

        return $this->render('admin/security/connexion.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    /**
     * @Route("/architect/deconnexion", name="adm_deconnexion")
     */
    public function logout(): void
    {
        throw new \Exception('This should never be reached!');
    }
}
