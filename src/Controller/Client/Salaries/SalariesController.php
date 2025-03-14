<?php

namespace App\Controller\Client\Salaries;

use App\Entity\Admin\Vision\Alerte;
use App\Entity\Client\Utilisateur;
use App\Form\Client\Salaries\Type\InscriptionType;
use App\Form\Client\Profil\InformationsPersonnelles\Type\ProfilType as InforPersoType;
use App\Entity\Client\Profil\Index;
use App\Entity\Client\Profil\InformationsPersonnelles\Profil as InfoPerso;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Contracts\Translation\TranslatorInterface;


class SalariesController extends AbstractController
{

    /**
     * @param Utilisateur    $user
     *
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/client/salaries/voir", name="cli_salaries")
     */
    public function voir(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_GESTIONNAIRE');
        $user = $this->getUser();
        $salaries = $user->getSalaries();
        $nomEntreprise = $user->getUsername();
        return $this->render('client/salaries/voir.html.twig', array(
            'user' => $user,
            'salaries' => $salaries,
            'nomEntreprise' => $nomEntreprise,
        ));
    }

    /**
     * @param Utilisateur    $user
     *
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/client/salaries/ajouter", name="cli_salaries_ajouter")
     */
    public function ajouter(Request $request, UserPasswordEncoderInterface $passwordEncoder, \Swift_Mailer $mailer, TranslatorInterface $translator)
    {
        $this->denyAccessUnlessGranted('ROLE_GESTIONNAIRE');
        $user = $this->getUser();
        $salarie = new Utilisateur();
        $profil = new Index();
        $infoPerso = new InfoPerso();

        // instancie le formulaire avec les contraintes par défaut, + la contrainte inscription pour que la saisie du mot de passe soit obligatoire
        $form = $this->createForm(InscriptionType::class, $salarie);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $password_clear = random_int(10441811, 13812424824);
            $message = (new \Swift_Message('Invitation à rejoindre POPULORUM SIRH'))
              ->setFrom('ne-pas-repondre@populorum.fr')
              ->setTo($salarie->getEmail())
              ->setBody(
              $this->renderView(
                  'client/salaries/mail/invitation.html.twig',
                      array(
                          'password' => $password_clear,
                          'email' => $salarie->getEmail(),
                           )
                      ),
                      'text/html'
                  )
              ;

            $mailer->send($message);


            // Encode le mot de passe
            $password = $passwordEncoder->encodePassword($salarie, $password_clear);
            $salarie->setPassword($password);

            $salarie->setProfil($profil);
            $salarie->setClient($user->getClient());
            $profil->setInformationsPersonnelles($infoPerso);
            $salarie->setUsername($salarie->getEmail());
            $salarie->setRoles(['ROLE_USER']);


            // Enregistre le membre en base
            $em = $this->getDoctrine()->getManager();
            $em->persist($salarie);
            $em->persist($profil);
            $em->flush();
            $message = $translator->trans('The account of the user has been saved');
            $this->addFlash('success', $message);

            return $this->redirectToRoute('cli_salaries_profil_modifier_informations_personnelles', ['id' => $salarie->getId()]);
        }
        return $this->render('client/salaries/ajouter.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/client/salaries/suppression/{id}", name="cli_salaries_suppression", methods="DELETE")
     */
    public function delete(Request $request, Utilisateur $salarie, $id, TranslatorInterface $translator): Response
    {
        $this->denyAccessUnlessGranted('ROLE_GESTIONNAIRE');
      if ($this->isCsrfTokenValid('delete'.$salarie->getId(), $request->request->get('_token'))) {
          $em = $this->getDoctrine()->getManager();
          $em->remove($salarie);
          $em->flush();
          $message = $translator->trans('The user has been deleted');
          $this->addFlash('notice', $message);
      }

      else {
          $message = $translator->trans('The user hasn\'t been deleted');
          $this->addFlash('notice', $message);
      }

        return $this->redirectToRoute('cli_salaries');
    }
}
