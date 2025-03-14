<?php

namespace App\Controller\Client\Security;

use App\Form\Client\Security\Type\ResetMdpType;
use App\Entity\Client\Utilisateur;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Services\Utilisateur\Mailer;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @Route("/mot-de-passe/oublier")
 */
class ResetMdpController extends AbstractController
{
    // si supérieur à 10min, retourne false
    // sinon retourne false
    private function isRequestInTime(\Datetime $passwordRequestedAt = null)
    {
         if ($passwordRequestedAt === null)
         {
             return false;
         }

         $now = new \DateTime();
         $interval = $now->getTimestamp() - $passwordRequestedAt->getTimestamp();

         $daySeconds = 60 * 10;
         $response = $interval > $daySeconds ? false : $reponse = true;
         return $response;
    }

    /**
     * @Route("/", name="cli_mdp_oublier")
     */
    public function request(Request $request, Mailer $mailer, TokenGeneratorInterface $tokenGenerator, TranslatorInterface $translator)
    {
        // création d'un formulaire "à la volée", afin que l'internaute puisse renseigner son mail
        $form = $this->createFormBuilder()
            ->add('email', EmailType::class, [
                'constraints' => [
                    new Email(),
                    new NotBlank()
                ]
            ])
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            // voir l'épisode 2 de cette série pour retrouver la méthode loadUserByUsername:
            $user = $em->getRepository(Utilisateur::class)->loadUserByUsername($form->getData()['email']);

            // aucun email associé à ce compte.
            if (!$user) {
                $message = $translator->trans('This email doesn\'t exist');
                $this->addFlash('danger', $message);
                return $this->redirectToRoute("cli_mdp_oublier");
            }

            // création du token
            $user->setToken($tokenGenerator->generateToken());
            // enregistrement de la date de création du token
            $user->setPasswordRequestedAt(new \Datetime());
            $em->flush();

            // on utilise le service Mailer créé précédemment
            $bodyMail = $mailer->createBodyMail('client/vitrine/security/resetMdp/mailResetMdp.html.twig', [
                'user' => $user
            ]);
            $mailer->sendMessage('ne-pas-repondre@populorum.fr', $user->getEmail(), 'Renouvellement du mot de passe', $bodyMail);
            $message = $translator->trans('An email has been sent for change your password. The link has been available for 24h');
            $this->addFlash('success', $message);

            return $this->redirectToRoute("cli_connexion");
        }

        return $this->render('client/vitrine/security/resetMdp/mdpOublier.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/{token}", name="cli_mdp_reset")
     */
    public function reset(Utilisateur $user, $token, Request $request, UserPasswordEncoderInterface $passwordEncoder, TranslatorInterface $translator)
    {
        // interdit l'accès à la page si:
        // le token associé au membre est null
        // le token enregistré en base et le token présent dans l'url ne sont pas égaux
        // le token date de plus de 10 minutes
        if ($user->getToken() === null || $token !== $user->getToken() || !$this->isRequestInTime($user->getPasswordRequestedAt()))
        {
            throw new AccessDeniedHttpException();
        }

        $form = $this->createForm(ResetMdpType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // réinitialisation du token à null pour qu'il ne soit plus réutilisable
            $user->setToken(null);
            $user->setPasswordRequestedAt(null);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $message = $translator->trans('Your password has been changed');
            $this->addFlash('success', $message);

            return $this->redirectToRoute('cli_connexion');

        }

        return $this->render('client/vitrine/security/resetMdp/mdpReset.html.twig', [
            'form' => $form->createView()
        ]);

    }

}
