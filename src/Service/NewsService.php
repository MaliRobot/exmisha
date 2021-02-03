<?php

namespace App\Service;

use App\Repository\NewsRepository;

/**
 * Class NewsService
 * @package App\Service
 */
class NewsService
{
    /**
     * @var NewsRepository
     */
    private $repository;

    /**
     * NewsService constructor.
     * @param NewsRepository $repository
     */
    public function __construct(NewsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return \App\Entity\News[]
     */
    public function getAllPublicNews()
    {
        return $this->repository->findBy(['public' => true], ['date_published' => 'DESC']);
    }
}