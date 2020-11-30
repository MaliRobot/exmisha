<?php

namespace App\Controller;

use App\Entity\Event;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    private $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    /**
     * @Route("/events", name="event")
     */
    public function index(): Response
    {
        return $this->render('event/index.html.twig', [
            'controller_name' => 'EventController',
        ]);
    }

    /**
     * @Route("/api/events/", name="import_events", methods={"POST"})
     */
    public function add(Request $request): JsonResponse
    {
        $entityManager = $this->getDoctrine()->getManager();

        $data = json_decode($request->getContent(), true);

        $id = $data['id'];
        $name = $data['name'];
        $description = $data['description'];
        $address = $data['address'];
        $city = $data['city'];
        $start = $data['start'];
        $end = $data['end'];
        $public = $data['public'];

        if (
            empty($name) ||
            empty($public) ||
            empty($description) ||
            empty($address) ||
            empty($city) ||
            empty($start) ||
            empty($end) ||
            empty($id)
        ) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $event = $this->eventRepository->findOneBy(['cid' => (int)$id]);
        if (!$event)
        {
            $event = new Event();
        }

        $event->setName($name);
        $event->setDescription($description);
        $event->setPublic($public);
        $event->setAddress($address);
        $event->setCity($city);
        $event->setStart(new \DateTime($start));
        $event->setEnd(new \DateTime($end));

        $entityManager->persist($event);
        $entityManager->flush();

        return new JsonResponse(['status' => 'Events imported'], Response::HTTP_CREATED);
    }
}
