<?php

namespace App\Controller\Client\Salaries\Profil\InformationsPersonnelles;

use App\Entity\Client\Utilisateur;
use App\Entity\Client\Profil\InformationsPersonnelles\Profil;
use App\Form\Client\Profil\InformationsPersonnelles\Type\ProfilType;
use App\Entity\Client\Profil\InformationsPersonnelles\PieceJointe;
use App\Form\Client\Profil\InformationsPersonnelles\PieceJointe\Type\PieceJointeType;
use App\Entity\Admin\Vision\Alerte;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @Route("/client/salaries/{id}/profil/informations-personnelles")
 */
class ProfilController extends AbstractController
{

    /**
     * @param Utilisateur    $user
     *
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/", name="cli_salaries_profil_informations_personnelles")
     */
    public function voir(Request $request, $id, TranslatorInterface $translator)
    {
        $user = $this->getUser();
        $salarie = $this->getDoctrine()->getRepository(Utilisateur::class)->find($id);
        $salaries = $user->getSalaries();

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

        $profilSalaries = $salarie->getProfil()->getInformationsPersonnelles();
        $idSalarie = $salarie->getId();
        $piecesJointes = $this->getDoctrine()->getRepository(PieceJointe::class)->findByUser($salarie);
        $pieceJointe = new PieceJointe();

        $form = $this->createForm(PieceJointeType::class, $pieceJointe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $pieceJointe->setUtilisateur($user->getProfil()->getInformationsPersonnelles()->getFirstname());
            $pieceJointe->setIdUtilisateur($idSalarie);
            $em = $this->getDoctrine()->getManager();
            $em->persist($pieceJointe);
            $em->flush();
            $message = $translator->trans('Your attachment has been added');
            $this->addFlash('notice', $message);
            return $this->redirectToRoute('cli_salaries_profil_informations_personnelles', ['id' => $id]);
        }

        return $this->render('client/profil/informationsPersonnelles/voir.html.twig', array(
            'salarie' => $salarie,
            'salaries' => $salaries,
            'profil' => $profilSalaries,
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
     * @Route("/modifier", name="cli_salaries_profil_modifier_informations_personnelles")
     */
    public function modifier(Request $request, $id, TranslatorInterface $translator)
    {
        $user = $this->getUser();
        $profil = $user->getProfil()->getInformationsPersonnelles();
        $salarie = $this->getDoctrine()->getRepository(Utilisateur::class)->find($id);
        $salaries = $user->getSalaries();
        $nameupdate = '';
        if ($profil) {
            $nameupdate = $profil->getFirstname();
        }
        if (!$this->isGranted('Modifier', $salarie))
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
        $profilSalaries = $salarie->getProfil()->getInformationsPersonnelles();
        $idSalarie = $salarie->getId();
        $form = $this->createForm(ProfilType::class, $profilSalaries,[
           'validation_groups' => array('Profil', 'profil'),
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $profilSalaries->setIdupdate($user->getId());
            $profilSalaries->setNameupdate($nameupdate);
            $profilSalaries->setDateupdate(new \DateTime());

            $em = $this->getDoctrine()->getManager();
            $em->persist($profilSalaries);
            $em->flush();

            $message = $translator->trans('Profile saved');
            $this->addFlash('notice', $message);

            return $this->redirectToRoute('cli_salaries_profil_informations_personnelles', ['id' => $id]);
        }

        return $this->render('client/profil/informationsPersonnelles/modifier.html.twig', array(
            'form' => $form->createView(),
            'user' => $user,
            'salarie' => $salarie,
            'salaries' => $salaries,
            'profil' => $profilSalaries,
        ));
    }
}
