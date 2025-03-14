<?php
namespace App\Controller\Client\Security;

use App\Entity\Client\Utilisateur;
use App\Entity\Client\Profil\Index;
use App\Entity\Client\Profil\InformationsEntreprise\Profil as InfoPro;
use App\Entity\Client\Profil\InformationsPersonnelles\Profil as InfoPerso;
use App\Form\Client\Security\Type\InscriptionType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class InscriptionController extends AbstractController
{
    /**
     * @Route("/inscription", name="cli_inscription")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, TranslatorInterface $translator)
    {
        $utilisateur = new Utilisateur();
        $profil = new Index();
        $infoPro = new InfoPro();
        $infoPerso = new InfoPerso();
        $plan = $request->get('plan');

        // instancie le formulaire avec les contraintes par défaut, + la contrainte inscription pour que la saisie du mot de passe soit obligatoire
        $form = $this->createForm(InscriptionType::class, $utilisateur, array(
           'validation_groups' => array('Inscription', 'inscription'),
           'plan' => $plan,
        ));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // Encode le mot de passe
            $password = $passwordEncoder->encodePassword($utilisateur, $utilisateur->getPlainPassword());
            $utilisateur->setPassword($password);

            $utilisateur->setProfil($profil);
            $profil->setInformationsEntreprise($infoPro);
            $profil->setInformationsPersonnelles($infoPerso);
            $infoPerso->setFirstname(' ');
            $utilisateur->setRoles(['ROLE_CLIENT']);
            $utilisateur->setUsername($utilisateur->getEmail());
            $utilisateur->setClient($utilisateur);
            $nomEntreprise = $form->get('profil')->get('informationsEntreprise')->get('nomEntreprise')->getData();
            $infoPro->setNomEntreprise($nomEntreprise);

            // Enregistre le membre en base
            $em = $this->getDoctrine()->getManager();
            $em->persist($utilisateur);
            $em->persist($profil);
            $em->persist($infoPro);
            $em->persist($infoPerso);
            $em->flush();
            $message = $translator->trans('Your account has been saved');
            $this->addFlash('success', $message);

            return $this->redirectToRoute('cli_connexion');
        }

        return $this->render(
            'client/vitrine/security/inscription.html.twig', array(
              'form' => $form->createView(),
              'plan' => $plan,
          )
        );
    }
}
