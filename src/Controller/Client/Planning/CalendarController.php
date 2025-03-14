<?php

namespace App\Controller\Client\Planning;

use App\Entity\Client\Utilisateur;
use App\Entity\Client\Planning\Event;
use App\Entity\Client\Planning\Tache;
use App\Entity\Client\Conge\Absence;
use App\Form\Client\Planning\Tache\Type\AddType;
use App\Form\Client\Planning\Event\Type\AddType as EventType;
use App\Form\Client\Planning\Event\Type\EditType;
use App\Form\Client\Conge\Type\AbsenceType;
use App\Entity\Admin\Vision\Alerte;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @Route("/client/planning")
 */
class CalendarController extends AbstractController
{
    /**
     * @Route("/", name="cli_planning_calendar")
     */
    public function voirPlanning(Request $request, TranslatorInterface $translator)
    {
        $user = $this->getUser();
        $id = $user->getId();
        $events = $this->getDoctrine()->getRepository(Event::class)->findByIdSalarie($id);

        if ($this->container->get('security.authorization_checker')->isGranted('ROLE_GESTIONNAIRE')) {
            $salaries = $user->getSalaries();
            $salarie = $this->getDoctrine()->getRepository(Utilisateur::class)->find($id);
            $taches = $this->getDoctrine()->getRepository(Tache::class)->findByClient($user->getClient());
            $tache = new Tache();
            $form = $this->createForm(AddType::class, $tache);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $tache->setClient($user->getClient()->getId());
                $em = $this->getDoctrine()->getManager();
                $em->persist($tache);
                $em->flush();
                $message = $translator->trans('Task added');
                $this->addFlash('notice', $message);
                return $this->redirectToRoute('cli_planning_calendar');
            }
          return $this->render('client/planning/calendar.html.twig', array(
              'salaries' => $salaries,
              'salarie' => $salarie,
              'events' => $events,
              'taches' => $taches,
              'form' => $form->createView(),
          ));
        }
        else {
          $absence = new Absence();
          $form = $this->createForm(AbsenceType::class, $absence);
          $form->handleRequest($request);
          if ($form->isSubmitted() && $form->isValid()) {
              $absence->setUtilisateur($user);
              $em = $this->getDoctrine()->getManager();
              $em->persist($absence);
              $em->flush();
              $message = $translator->trans('Absence request sent');
              $this->addFlash('notice', $message);
              return $this->redirectToRoute('cli_planning_calendar');
          }
          return $this->render('client/planning/calendar.html.twig', array(
              'salarie' => $user,
              'events' => $events,
              'form' => $form->createView(),
          ));
        }
    }

    /**
     * @Route("/salarie/{id}", name="cli_salaries_planning_calendar")
     */
    public function voirPlanningSalaries(Request $request, $id, TranslatorInterface $translator)
    {
        $user = $this->getUser();
        $idUser = $user->getId();

        $salaries = $user->getSalaries();
        $events = $this->getDoctrine()->getRepository(Event::class)->findByIdSalarie($id);
        $taches = $this->getDoctrine()->getRepository(Tache::class)->findByClient($user->getClient());

        $tache = new Tache();
        $form = $this->createForm(AddType::class, $tache);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $tache->setClient($user->getClient()->getId());
            $em = $this->getDoctrine()->getManager();
            $em->persist($tache);
            $em->flush();
            $message = $translator->trans('Task added');
            $this->addFlash('notice', $message);
            return $this->redirectToRoute('cli_planning_calendar');
        }


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
        $event = new Event;

        return $this->render('client/planning/calendar.html.twig', array(
            'salaries' => $salaries,
            'salarie' => $salarie,
            'taches' => $taches,
            'events' => $events,
            'idSalarie' => $id,
            'form' => $form->createView(),
        ));
    }
    /**
     * @Route("/modifier/{idEvent}", name="cli_planning_event_edit")
     */
    public function modifier(Request $request, $idEvent, \Swift_Mailer $mailer, TranslatorInterface $translator): Response
    {
        $user = $this->getUser();
        $idUser = $user->getId();

        $event = $this->getDoctrine()->getRepository(Event::class)->find($idEvent);
        if (!$this->isGranted('Modifier', $event) and $this->isGranted('ROLE_ADMIN'))
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

           $event = $this->getDoctrine()->getRepository(Event::class)->find($idEvent);
           $form = $this->createForm(EditType::class, $event);
           if ($form->isSubmitted() && $form->isValid()) {

             $startDate = $request->get('start');
             $endDate = $request->get('end');
               $em = $this->getDoctrine()->getManager();
               $event->setStart(new \DateTime($request->get('start')));
               $event->setEnd(new \DateTime($request->get('end')));
               $em->flush();
               $message = $translator->trans('Task added');
               $this->addFlash('notice', $message);
               return $this->redirectToRoute('cli_salaries_planning_calendar', ['id' => $id]);
           }

        return $this->render('client/planning/edit_form.html.twig', array(
            'editForm' => $form->createView(),
            'idEvent' => $idEvent,
        ));
    }

    /**
     * @param Request $request
     * @Route("/deplacement", name="cli_planning_calendar_drop")
     */
    public function dropEvent(Request $request)
    {
        if ($request->isXmlHttpRequest())
        {
          $idEvent = $request->get('idEvent');
          $startDate = $request->get('start');
          $endDate = $request->get('end');

          $event = $this->getDoctrine()->getRepository(Event::class)->find($idEvent);
          $form = $this->createForm(EventType::class, $event);
          $form->handleRequest($request);
          $event->setStart(new \DateTime($request->get('start')));
          $event->setEnd(new \DateTime($request->get('end')));
              $em = $this->getDoctrine()->getManager();
              $em->flush();

        }
          return new Response("Modification  du planning.");

    }

    /**
     * @param Request $request
     * @Route("/resize", name="cli_planning_calendar_resize")
     */
    public function eventResize(Request $request)
    {
        if ($request->isXmlHttpRequest())
        {
          $idEvent = $request->get('idEvent');
          $startDate = $request->get('start');
          $endDate = $request->get('end');

          $event = $this->getDoctrine()->getRepository(Event::class)->find($idEvent);
          $form = $this->createForm(EventType::class, $event);
          $form->handleRequest($request);
          $event->setStart(new \DateTime($request->get('start')));
          $event->setEnd(new \DateTime($request->get('end')));
              $em = $this->getDoctrine()->getManager();
              $em->flush();

        }
          return new Response("Modification  du planning.");
    }

    /**
     * @param Request $request
     * @Route("/{id}/ajout", name="cli_planning_calendar_ajout")
     */
    public function eventReceive(Request $request, $id, TranslatorInterface $translator)
    {
      if ($request->isXmlHttpRequest())
      {

        $idEvent = $request->get('id');
        $title = $request->get('title');
        $color = $request->get('color');
        $startDate = $request->get('start');
        $endDate = $request->get('end');

        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);
            $event->setIdUtilisateur($id);
            $event->setTitle($title);
            $event->setColor($color);
            $event->setStart(new \DateTime($request->get('start')));
            $event->setEnd(new \DateTime($request->get('end')));
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();
            $message = $translator->trans('Task added');
            $this->addFlash('notice', $message);

      }

        return new Response("Ajout au planning.");
    }

    /**
     * @Route("/suppression", name="cli_planning_event_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TranslatorInterface $translator): Response
    {
        $idEvent = $request->get('idEvent');

        $event = $this->getDoctrine()->getRepository(Event::class)->find($idEvent);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($event);
            $entityManager->flush();

            $message = $translator->trans('Task deleted');
            $this->addFlash('notice', $message);

        return $this->redirectToRoute('cli_salaries_planning_calendar', ['id' => $idEvent]);
    }

}
