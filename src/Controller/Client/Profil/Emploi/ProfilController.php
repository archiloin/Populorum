<?php

namespace App\Controller\Client\Profil\Emploi;

use App\Entity\Client\Utilisateur;
use App\Entity\Client\Profil\Emploi\Profil;
use App\Form\Client\Profil\Emploi\Type\ProfilType;
use App\Entity\Client\Profil\Emploi\PieceJointe;
use App\Form\Client\Profil\Emploi\PieceJointe\Type\PieceJointeType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @Route("/client/profil/emploi")
 */
class ProfilController extends AbstractController
{

    /**
     * @param Utilisateur    $user
     *
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/", name="cli_profil_emploi")
     */
    public function voir(Request $request, TranslatorInterface $translator)
    {
        $user = $this->getUser();
        $idUser = $user->getId();
        $profil = $user->getProfil()->getEmploi();

        if ($profil == null) {
            $profil = new Profil();
            $user->getProfil()->setEmploi($profil);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($profil);
        $em->flush();

        $piecesJointes = $this->getDoctrine()->getRepository(PieceJointe::class)->findByUser($user);
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
            return $this->redirectToRoute('cli_profil_emploi');
        }

        return $this->render('client/profil/emploi/voir.html.twig', array(
            'profil' => $profil,
            'user' => $user,
            'piecesJointes' => $piecesJointes,
            'form' => $form->createView(),
        ));
    }

}
