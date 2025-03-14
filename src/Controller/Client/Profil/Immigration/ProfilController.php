<?php

namespace App\Controller\Client\Profil\Immigration;

use App\Entity\Client\Utilisateur;
use App\Form\Client\Profil\Immigration\Type\ProfilType;
use App\Entity\Client\Profil\Immigration\PieceJointe;
use App\Entity\Client\Profil\Immigration\Profil;
use App\Form\Client\Profil\Immigration\PieceJointe\Type\PieceJointeType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/client/profil/immigration")
 */
class ProfilController extends AbstractController
{

    /**
     * @param Utilisateur    $user
     *
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/", name="cli_profil_immigration")
     */
    public function voir(Request $request)
    {
        $user = $this->getUser();
        $profil = $user->getProfil();
        $idUser = $user->getId();
        $piecesJointes = $this->getDoctrine()->getRepository(PieceJointe::class)->findByUser($user);
        $immigrations = $this->getDoctrine()->getRepository(Profil::class)->findByUser($user);

        $immigration = new Profil();

        $profilForm = $this->createForm(ProfilType::class, $immigration);
        $profilForm->handleRequest($request);
        if ($profilForm->isSubmitted() && $profilForm->isValid()) {
            $immigration->setIdUtilisateur($idUser);
            $em = $this->getDoctrine()->getManager();
            $em->persist($immigration);
            $em->flush();
            $this->addFlash(
            'notice',
            'Profil enregistré'
            );
            return $this->redirectToRoute('cli_profil_immigration');
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
            $this->addFlash(
            'notice',
            'Votre pièce jointe vient d\'être ajouté.'
            );
            return $this->redirectToRoute('cli_profil_immigration');
        }

        return $this->render('client/profil/immigration/voir.html.twig', array(
            'user' => $user,
            'profil' => $profil,
            'immigrations' => $immigrations,
            'piecesJointes' => $piecesJointes,
            'profilForm' => $profilForm->createView(),
            'form' => $form->createView(),
        ));
    }

}
