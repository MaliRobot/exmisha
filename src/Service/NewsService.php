<?php

namespace App\Service;

use App\Repository\NewsRepository;


class NewsService
{
    private $repository;

    public function __construct(NewsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllPublicNews()
    {
        return $this->repository->findBy(['public' => true], ['date_published' => 'DESC']);
    }
}