<?php

namespace App\Controller\Client;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    /**
     * @Route("/client/Conditions-Generales-d'Utilisation", name="cli_footer_cgu")
     */
    public function cgu()
    {
        return $this->render('client/footer/cgu.html.twig');
    }

    /**
     * @Route("/client/Politique-de-Protection-des-Donnees-Personnelles", name="cli_footer_protection")
     */
    public function protection()
    {
        return $this->render('client/footer/protection.html.twig');
    }

    /**
     * @Route("/client/Mentions-Legales", name="cli_footer_mentions")
     */
    public function mentions()
    {
        return $this->render('client/footer/mentions.html.twig');
    }

    /**
     * @Route("/", name="accueil")
     */
    public function accueil()
    {
        return $this->render('client/vitrine/index.html.twig');
    }

    /**
     * @Route("/client/mon-compte", name="cli_plan")
     */
    public function plan()
    {
        $user = $this->getUser();

        return $this->render('client/plan.html.twig', array(
            'user' => $user,
        ));
    }

    /**
     * @Route("/modifier-locale/{locale}", name="change_locale")
     */
    public function indexChangeLocale(Request $request, $locale)
    {
				$request->getSession()->set('_locale', $locale);

				return $this->redirect($request->headers->get('referer'));
    }

    /**
     * @Route("/client/modifier-locale/{locale}", name="cli_change_locale")
     */
    public function changeLocale(Request $request, $locale)
    {
				$request->getSession()->set('_locale', $locale);

				return $this->redirect($request->headers->get('referer'));
    }
}
