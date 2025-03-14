<?php

namespace App\Controller\Client\Profil\Certifications;

use App\Entity\Client\Utilisateur;
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

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @Route("/client/profil/certifications")
 */
class ProfilController extends AbstractController
{

    /**
     * @param Utilisateur    $user
     *
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/", name="cli_profil_certifications")
     */
    public function voir(Request $request, TranslatorInterface $translator)
    {
        $user = $this->getUser();
        $profil = $user->getProfil();
        $idUser = $user->getId();

        $exps = $this->getDoctrine()->getRepository(Exp::class)->findByUser($user);
        $exp = new Exp();
        $expForm = $this->createForm(ExpType::class, $exp);
        $expForm->handleRequest($request);
        if ($expForm->isSubmitted() && $expForm->isValid()) {
            $exp->setIdUtilisateur($idUser);
            $em = $this->getDoctrine()->getManager();
            $em->persist($exp);
            $em->flush();
            $message = $translator->trans('Profile saved');
            $this->addFlash('notice', $message);
            return $this->redirectToRoute('cli_profil_certifications');
        }

        $etudess = $this->getDoctrine()->getRepository(Etudes::class)->findByUser($user);
        $etudes = new Etudes();
        $etudesForm = $this->createForm(EtudesType::class, $etudes);
        $etudesForm->handleRequest($request);
        if ($etudesForm->isSubmitted() && $etudesForm->isValid()) {
            $etudes->setIdUtilisateur($idUser);
            $em = $this->getDoctrine()->getManager();
            $em->persist($etudes);
            $em->flush();
            $message = $translator->trans('Profile saved');
            $this->addFlash('notice', $message);
            return $this->redirectToRoute('cli_profil_certifications');
        }

        $languess = $this->getDoctrine()->getRepository(Langues::class)->findByUser($user);
        $langues = new Langues();
        $languesForm = $this->createForm(LanguesType::class, $langues);
        $languesForm->handleRequest($request);
        if ($languesForm->isSubmitted() && $languesForm->isValid()) {
            $langues->setIdUtilisateur($idUser);
            $em = $this->getDoctrine()->getManager();
            $em->persist($langues);
            $em->flush();
            $message = $translator->trans('Profile saved');
            $this->addFlash('notice', $message);
            return $this->redirectToRoute('cli_profil_certifications');
        }

        $skills = $this->getDoctrine()->getRepository(Skill::class)->findByUser($user);
        $skill = new Skill();
        $skillForm = $this->createForm(SkillType::class, $skill);
        $skillForm->handleRequest($request);
        if ($skillForm->isSubmitted() && $skillForm->isValid()) {
            $skill->setIdUtilisateur($idUser);
            $em = $this->getDoctrine()->getManager();
            $em->persist($skill);
            $em->flush();
            $message = $translator->trans('Profile saved');
            $this->addFlash('notice', $message);
            return $this->redirectToRoute('cli_profil_certifications');
        }

        $permiss = $this->getDoctrine()->getRepository(Permis::class)->findByUser($user);
        $permis = new Permis();
        $permisForm = $this->createForm(PermisType::class, $permis);
        $permisForm->handleRequest($request);
        if ($permisForm->isSubmitted() && $permisForm->isValid()) {
            $permis->setIdUtilisateur($idUser);
            $em = $this->getDoctrine()->getManager();
            $em->persist($permis);
            $em->flush();
            $message = $translator->trans('Profile saved');
            $this->addFlash('notice', $message);
            return $this->redirectToRoute('cli_profil_certifications');
        }

        $piecesJointes = $this->getDoctrine()->getRepository(PieceJointe::class)->findByUser($user);
        $pieceJointe = new PieceJointe();

        $form = $this->createForm(PieceJointeType::class, $pieceJointe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $pieceJointe->setIdUtilisateur($idUser);
            $pieceJointe->setUtilisateur($user->getProfil()->getInformationsPersonnelles()->getFirstname());
            $em = $this->getDoctrine()->getManager();
            $em->persist($pieceJointe);
            $em->flush();
            $message = $translator->trans('Your attachment has been added');
            $this->addFlash('notice', $message);
            return $this->redirectToRoute('cli_profil_certifications');
        }

        return $this->render('client/profil/certifications/voir.html.twig', array(
            'user' => $user,
            'profil' => $profil,
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
