<?php

namespace App\Controller;

use App\Entity\Event;
use App\Repository\EventRepository;
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
     * @param EventRepository $eventRepository
     * @return Response
     */
    public function events(EventRepository $eventRepository): Response
    {
        return $this->render('event/list.html.twig', [
            'title'=> 'События',
            'events' => $eventRepository->findAll()
        ]);
    }
}
