<?php

namespace App\Controller;

use App\Entity\Event;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    /**
     * @Route("/event/{slug}", name="event")
     * @param Event $event
     * @return Response
     */
    public function index(Event $event): Response
    {
        return $this->render('event/index.html.twig', [
            'event' => $event
        ]);
    }

    /**
     * @Route("/events", name="events")
     * @return Response
     */
    public function events(): Response
    {
        return $this->render('event/list.html.twig', [
            'title'=> 'Events',
            'events' => $this->getDoctrine()
                ->getManager()
                ->getRepository(Event::class)
                ->findAll()
        ]);
    }
}
