<?php

namespace App\Service;

use App\Repository\EventRepository;

/**
 * Class EventService
 * @package App\Service
 */
class EventService
{
    /**
     * @var EventRepository
     */
    private $repository;

    /**
     * EventService constructor.
     * @param EventRepository $repository
     */
    public function __construct(EventRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return \App\Entity\Event[]
     */
    public function getAllPublicEvents()
    {
        return $this->repository->findBy(['public' => true], ['start' => 'DESC']);
    }
}