<?php

namespace App\Service;

use App\Repository\AlbumRepository;


class AlbumService
{
    private $repository;

    public function __construct(AlbumRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllPublicAlbums()
    {
        return $this->repository->findBy(['public' => true], ['release_date' => 'DESC']);
    }
}