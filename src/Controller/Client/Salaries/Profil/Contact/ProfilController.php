<?php

namespace App\Controller\Client\Salaries\Profil\Contact;

use App\Entity\Client\Utilisateur;
use App\Entity\Client\Profil\Contact\Profil;
use App\Form\Client\Profil\Contact\Type\ProfilType;
use App\Entity\Client\Profil\Contact\PieceJointe;
use App\Form\Client\Profil\Contact\PieceJointe\Type\PieceJointeType;
use App\Entity\Admin\Vision\Alerte;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @Route("/client/salaries/{id}/profil/contact")
 */
class ProfilController extends AbstractController
{

    /**
     * @param Utilisateur    $user
     *
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/", name="cli_salaries_profil_contact")
     */
    public function voir(Request $request, $id, TranslatorInterface $translator)
    {
        $user = $this->getUser();
        $profil = $user->getProfil();
        $salarie = $this->getDoctrine()->getRepository(Utilisateur::class)->find($id);
        $salaries = $user->getSalaries();
        $profilSalarie = $salarie->getProfil();

        if (!$this->isGranted('Voir', $salarie))
        {
              $alerte = new Alerte();
              $alerte->setUtilisateur($user->getId());
              $alerte->setNiveau(2);
              $alerte->setType('Manipulation URL');
              $alerte->setIp($_SERVER['REMOTE_ADDR']);
              $alerte->setUserAgent($_SERVER['HTTP_USER_AGENT']);
              $alerte->setUrl($_SERVER['REQUEST_URI']);

              $em = $this->getDoctrine()->getManager();
              $em->persist($alerte);
              $em->flush();
              $entityManager = $this->getDoctrine()->getManager();
              $user->setIsActive(true);
              $entityManager->flush();

              return $this->render('vision/bannissement/police.html.twig');
        }

        $contacts = $this->getDoctrine()->getRepository(Profil::class)->findByUser($salarie);
        $idSalarie = $salarie->getId();

        $profilSalaries = new Profil();

        $profilForm = $this->createForm(ProfilType::class, $profilSalaries);
        $profilForm->handleRequest($request);
        if ($profilForm->isSubmitted() && $profilForm->isValid()) {
            $profilSalaries->setIdUtilisateur($idSalarie);
            $em = $this->getDoctrine()->getManager();
            $em->persist($profilSalaries);
            $em->flush();
            $message = $translator->trans('Profile saved');
            $this->addFlash('notice', $message);
            return $this->redirectToRoute('cli_salaries_profil_contact', ['id' => $id]);
        }

        $piecesJointes = $this->getDoctrine()->getRepository(PieceJointe::class)->findByUser($salarie);
        $pieceJointe = new PieceJointe();

        $form = $this->createForm(PieceJointeType::class, $pieceJointe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $pieceJointe->setUtilisateur($user->getProfil()->getInformationsPersonnelles()->getFirstname());
            $pieceJointe->setIdUtilisateur($salarie->getId());
            $em = $this->getDoctrine()->getManager();
            $em->persist($pieceJointe);
            $em->flush();
            $message = $translator->trans('Your attachment has been added');
            $this->addFlash('notice', $message);
            return $this->redirectToRoute('cli_salaries_profil_contact', ['id' => $id]);
        }

        return $this->render('client/profil/contact/voir.html.twig', array(
            'salarie' => $salarie,
            'salaries' => $salaries,
            'contacts' => $contacts,
            'user' => $user,
            'idSalarie' => $idSalarie,
            'piecesJointes' => $piecesJointes,
            'profilForm' => $profilForm->createView(),
            'form' => $form->createView(),
        ));
    }
}
