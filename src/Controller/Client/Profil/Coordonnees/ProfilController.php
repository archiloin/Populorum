<?php

namespace App\Controller\Client\Profil\Coordonnees;

use App\Entity\Client\Utilisateur;
use App\Entity\Client\Profil\Coordonnees\Profil;
use App\Form\Client\Profil\Coordonnees\Type\ProfilType;
use App\Entity\Client\Profil\Coordonnees\PieceJointe;
use App\Form\Client\Profil\Coordonnees\PieceJointe\Type\PieceJointeType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @Route("/client/profil/coordonnees")
 */
class ProfilController extends AbstractController
{

    /**
     * @param Utilisateur    $user
     *
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/", name="cli_profil_coordonnees")
     */
    public function voir(Request $request, TranslatorInterface $translator)
    {
        $user = $this->getUser();
        $idUser = $user->getId();
        $profil = $user->getProfil()->getCoordonnees();

        if ($profil == null) {
            $profil = new Profil();
            $user->getProfil()->setCoordonnees($profil);
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
            return $this->redirectToRoute('cli_profil_coordonnees');
        }

        return $this->render('client/profil/coordonnees/voir.html.twig', array(
            'profil' => $profil,
            'user' => $user,
            'piecesJointes' => $piecesJointes,
            'form' => $form->createView(),
        ));
    }

    /**
     * @param Utilisateur    $user
     * @param Request $request
     *
     * @Method({"GET", "POST"})
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/modifier", name="cli_profil_modifier_coordonnees")
     */
    public function modifier(Request $request, TranslatorInterface $translator)
    {
        $user = $this->getUser();
        $profil = $user->getProfil()->getCoordonnees();
        $nameupdate = '';
        if ($profil) {
            $nameupdate = $user->getProfil()->getInformationsPersonnelles()->getFirstname();
        }
        if ($profil == null) {
            $profil = new Profil();
            $user->getProfil()->setCoordonnees($profil);
        }


        $form = $this->createForm(ProfilType::class, $profil,[
           'validation_groups' => array('Profil', 'profil'),
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $profil->setIdupdate($user->getId());
            $profil->setNameupdate($nameupdate);
            $profil->setDateupdate(new \DateTime());

            $em = $this->getDoctrine()->getManager();
            $em->persist($profil);
            $em->flush();

            $message = $translator->trans('Profile saved');
            $this->addFlash('notice', $message);

            return $this->redirectToRoute('cli_profil_coordonnees');
        }

        return $this->render('client/profil/coordonnees/modifier.html.twig', array(
            'form' => $form->createView(),
            'user' => $user,
            'profil' => $profil,
        ));
    }

}
