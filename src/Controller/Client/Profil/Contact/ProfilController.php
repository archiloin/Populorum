<?php

namespace App\Controller\Client\Profil\Contact;

use App\Entity\Client\Utilisateur;
use App\Form\Client\Profil\Contact\Type\ProfilType;
use App\Entity\Client\Profil\Contact\PieceJointe;
use App\Entity\Client\Profil\Contact\Profil;
use App\Form\Client\Profil\Contact\PieceJointe\Type\PieceJointeType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @Route("/client/profil/contact")
 */
class ProfilController extends AbstractController
{

    /**
     * @param Utilisateur    $user
     *
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/", name="cli_profil_contact")
     */
    public function voir(Request $request, TranslatorInterface $translator)
    {
        $user = $this->getUser();
        $profil = $user->getProfil();
        $idUser = $user->getId();
        $piecesJointes = $this->getDoctrine()->getRepository(PieceJointe::class)->findByUser($user);
        $contacts = $this->getDoctrine()->getRepository(Profil::class)->findByUser($user);

        $contact = new Profil();

        $profilForm = $this->createForm(ProfilType::class, $contact);
        $profilForm->handleRequest($request);
        if ($profilForm->isSubmitted() && $profilForm->isValid()) {
            $contact->setIdUtilisateur($idUser);
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();
            $message = $translator->trans('Profile saved');
            $this->addFlash('notice', $message);
            return $this->redirectToRoute('cli_profil_contact');
        }

        $pieceJointe = new PieceJointe();

        $form = $this->createForm(PieceJointeType::class, $pieceJointe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $pieceJointe->setUtilisateur($user->getProfil()->getInformationsPersonnelles()->getFirstname());
            $pieceJointe->setIdUtilisateur($idUser);
            $em = $this->getDoctrine()->getManager();
            $em->persist($pieceJointe);
            $em->flush();
            $message = $translator->trans('Your attachment has been added');
            $this->addFlash('notice', $message);
            return $this->redirectToRoute('cli_profil_contact');
        }

        return $this->render('client/profil/contact/voir.html.twig', array(
            'user' => $user,
            'profil' => $profil,
            'contacts' => $contacts,
            'piecesJointes' => $piecesJointes,
            'profilForm' => $profilForm->createView(),
            'form' => $form->createView(),
        ));
    }

}
