<?php

namespace App\Controller\Client\Skills;

use App\Entity\Client\Utilisateur;
use App\Entity\Client\Skills\Skills;
use App\Form\Client\Skills\Type\AddType;
use App\Entity\Admin\Vision\Alerte;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\Translation\TranslatorInterface;

class SkillsController extends AbstractController
{
    /**
     * @Route("/client/competences", name="cli_skills")
     */
    public function add(Request $request, TranslatorInterface $translator)
    {
        $user = $this->getUser();
        $id = $user->getId();

        $salaries = $user->getSalaries();

        $skills = $this->getDoctrine()->getRepository(Skills::class)->findByIdSalarie($id);

        $skill = new Skills();
        $form = $this->createForm(AddType::class, $skill);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $skill->setUtilisateur($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($skill);
            $em->flush();

            $message = $translator->trans('Added skill');
            $this->addFlash('notice', $message);
            return $this->redirectToRoute('cli_skills');
        }

        return $this->render('client/skills/add.html.twig', array(
            'salaries' => $salaries,
            'salarie' => $user,
            'skills' => $skills,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/client/{id}/competences/voir", name="cli_skills_voir")
     */
    public function voir(Request $request, $id, TranslatorInterface $translator)
    {
        $user = $this->getUser();
        $idUser = $user->getId();

        $salaries = $user->getSalaries();
        $salarie = $this->getDoctrine()->getRepository(Utilisateur::class)->find($id);

        // Nécessaire à la sécurité, empêche la manipulation d'url
        if (!$this->isGranted('Voir', $salarie))
        {
              $alerte = new Alerte();
              $alerte->setUtilisateur($idUser);
              $alerte->setNiveau(2);
              $alerte->setType('Manipulation URL');
              $alerte->setIp($_SERVER['REMOTE_ADDR']);
              $alerte->setUserAgent($_SERVER['HTTP_USER_AGENT']);
              $alerte->setUrl($_SERVER['REQUEST_URI']);

              $em = $this->getDoctrine()->getManager();
              $em->persist($alerte);
              $em->flush();
              $entityManager = $this->getDoctrine()->getManager();
              $entityManager->flush();

              return $this->render('vision/bannissement/police.html.twig');
        }

        $skills = $this->getDoctrine()->getRepository(Skills::class)->findByIdSalarie($id);

        $skill = new Skills();
        $form = $this->createForm(AddType::class, $skill);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $skill->setUtilisateur($salarie);
            $em->persist($skill);
            $em->flush();
            $message = $translator->trans('Added skill');
            $this->addFlash('notice', $message);
            return $this->redirectToRoute('cli_skills_voir', ['id' => $id]);
        }
        return $this->render('client/skills/add.html.twig', array(
            'salaries' => $salaries,
            'salarie' => $salarie,
            'skills' => $skills,
            'form' => $form->createView(),
        ));
    }
}
