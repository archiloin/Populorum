<?php

namespace App\Controller\Client\Profil\Personnes;

use App\Entity\Client\Utilisateur;
use App\Form\Client\Profil\Personnes\Type\ProfilType;
use App\Entity\Client\Profil\Personnes\PieceJointe;
use App\Entity\Client\Profil\Personnes\Profil;
use App\Form\Client\Profil\Personnes\PieceJointe\Type\PieceJointeType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @Route("/client/profil/personnes")
 */
class ProfilController extends AbstractController
{

    /**
     * @param Utilisateur    $user
     *
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/", name="cli_profil_personnes")
     */
    public function voir(Request $request, TranslatorInterface $translator)
    {
        $user = $this->getUser();
        $profil = $user->getProfil();
        $idUser = $user->getId();
        $piecesJointes = $this->getDoctrine()->getRepository(PieceJointe::class)->findByUser($user);
        $personness = $this->getDoctrine()->getRepository(Profil::class)->findByUser($user);

        $personnes = new Profil();

        $profilForm = $this->createForm(ProfilType::class, $personnes);
        $profilForm->handleRequest($request);
        if ($profilForm->isSubmitted() && $profilForm->isValid()) {
            $personnes->setIdUtilisateur($idUser);
            $em = $this->getDoctrine()->getManager();
            $em->persist($personnes);
            $em->flush();
            $message = $translator->trans('Profile saved');
            $this->addFlash('notice', $message);
            return $this->redirectToRoute('cli_profil_personnes');
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
            return $this->redirectToRoute('cli_profil_personnes');
        }

        return $this->render('client/profil/personnes/voir.html.twig', array(
            'user' => $user,
            'profil' => $profil,
            'personness' => $personness,
            'piecesJointes' => $piecesJointes,
            'profilForm' => $profilForm->createView(),
            'form' => $form->createView(),
        ));
    }

}
