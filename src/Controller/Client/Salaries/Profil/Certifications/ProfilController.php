<?php

namespace App\Controller\Client\Salaries\Profil\Certifications;

use App\Entity\Client\Utilisateur;
use App\Entity\Client\Profil\Certifications\Profil;
use App\Form\Client\Profil\Certifications\Type\ProfilType;
use App\Entity\Client\Profil\Certifications\PieceJointe;
use App\Form\Client\Profil\Certifications\PieceJointe\Type\PieceJointeType;
use App\Entity\Client\Profil\Certifications\Exp;
use App\Form\Client\Profil\Certifications\Exp\Type\ProfilType as ExpType;
use App\Entity\Client\Profil\Certifications\Etudes;
use App\Form\Client\Profil\Certifications\Etudes\Type\ProfilType as EtudesType;
use App\Entity\Client\Profil\Certifications\Langues;
use App\Form\Client\Profil\Certifications\Langues\Type\ProfilType as LanguesType;
use App\Entity\Client\Profil\Certifications\Skill;
use App\Form\Client\Profil\Certifications\Skill\Type\ProfilType as SkillType;
use App\Entity\Client\Profil\Certifications\Permis;
use App\Form\Client\Profil\Certifications\Permis\Type\ProfilType as PermisType;
use App\Entity\Admin\Vision\Alerte;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @Route("/client/salaries/{id}/profil/certifications")
 */
class ProfilController extends AbstractController
{

    /**
     * @param Utilisateur    $user
     *
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/", name="cli_salaries_profil_certifications")
     */
    public function voir(Request $request, $id, TranslatorInterface $translator)
    {
        $user = $this->getUser();
        $profil = $user->getProfil();
        $salarie = $this->getDoctrine()->getRepository(Utilisateur::class)->find($id);
        $salaries = $user->getSalaries();
        $profilSalarie = $salarie->getProfil();
        $idSalarie = $salarie->getId();

        // Nécessaire à la sécurité, empêche la manipulation d'url
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

        $exps = $this->getDoctrine()->getRepository(Exp::class)->findByUser($salarie);
        $exp = new Exp();
        $expForm = $this->createForm(ExpType::class, $exp);
        $expForm->handleRequest($request);
        if ($expForm->isSubmitted() && $expForm->isValid()) {
            $exp->setIdUtilisateur($idSalarie);
            $em = $this->getDoctrine()->getManager();
            $em->persist($exp);
            $em->flush();
            $message = $translator->trans('Profile saved');
            $this->addFlash('notice', $message);
            return $this->redirectToRoute('cli_salaries_profil_certifications', ['id' => $id]);
        }

        $etudess = $this->getDoctrine()->getRepository(Etudes::class)->findByUser($salarie);
        $etudes = new Etudes();
        $etudesForm = $this->createForm(EtudesType::class, $etudes);
        $etudesForm->handleRequest($request);
        if ($etudesForm->isSubmitted() && $etudesForm->isValid()) {
            $etudes->setIdUtilisateur($idSalarie);
            $em = $this->getDoctrine()->getManager();
            $em->persist($etudes);
            $em->flush();
            $message = $translator->trans('Profile saved');
            $this->addFlash('notice', $message);
            return $this->redirectToRoute('cli_salaries_profil_certifications', ['id' => $id]);
        }

        $languess = $this->getDoctrine()->getRepository(Langues::class)->findByUser($salarie);
        $langues = new Langues();
        $languesForm = $this->createForm(LanguesType::class, $langues);
        $languesForm->handleRequest($request);
        if ($languesForm->isSubmitted() && $languesForm->isValid()) {
            $langues->setIdUtilisateur($idSalarie);
            $em = $this->getDoctrine()->getManager();
            $em->persist($langues);
            $em->flush();
            $message = $translator->trans('Profile saved');
            $this->addFlash('notice', $message);
            return $this->redirectToRoute('cli_salaries_profil_certifications', ['id' => $id]);
        }

        $skills = $this->getDoctrine()->getRepository(Skill::class)->findByUser($salarie);
        $skill = new Skill();
        $skillForm = $this->createForm(SkillType::class, $skill);
        $skillForm->handleRequest($request);
        if ($skillForm->isSubmitted() && $skillForm->isValid()) {
            $skill->setIdUtilisateur($idSalarie);
            $em = $this->getDoctrine()->getManager();
            $em->persist($skill);
            $em->flush();
            $message = $translator->trans('Profile saved');
            $this->addFlash('notice', $message);
            return $this->redirectToRoute('cli_salaries_profil_certifications', ['id' => $id]);
        }

        $permiss = $this->getDoctrine()->getRepository(Permis::class)->findByUser($salarie);
        $permis = new Permis();
        $permisForm = $this->createForm(PermisType::class, $permis);
        $permisForm->handleRequest($request);
        if ($permisForm->isSubmitted() && $permisForm->isValid()) {
            $permis->setIdUtilisateur($idSalarie);
            $em = $this->getDoctrine()->getManager();
            $em->persist($permis);
            $em->flush();
            $message = $translator->trans('Profile saved');
            $this->addFlash('notice', $message);
            return $this->redirectToRoute('cli_salaries_profil_certifications', ['id' => $id]);
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
            return $this->redirectToRoute('cli_salaries_profil_certifications', ['id' => $id]);
        }

        return $this->render('client/profil/certifications/voir.html.twig', array(
            'salarie' => $salarie,
            'salaries' => $salaries,
            'user' => $user,
            'exps' => $exps,
            'etudess' => $etudess,
            'languess' => $languess,
            'skills' => $skills,
            'permiss' => $permiss,
            'piecesJointes' => $piecesJointes,
            'expForm' => $expForm->createView(),
            'etudesForm' => $etudesForm->createView(),
            'languesForm' => $languesForm->createView(),
            'skillForm' => $skillForm->createView(),
            'permisForm' => $permisForm->createView(),
            'form' => $form->createView(),
        ));
    }
}
