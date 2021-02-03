<?php

namespace App\Service;

use App\Repository\AlbumRepository;

/**
 * Class AlbumService
 * @package App\Service
 */
class AlbumService
{
    /**
     * @var AlbumRepository
     */
    private $repository;

    /**
     * AlbumService constructor.
     * @param AlbumRepository $repository
     */
    public function __construct(AlbumRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return \App\Entity\Album[]
     */
    public function getAllPublicAlbums()
    {
        return $this->repository->findBy(['public' => true], ['release_date' => 'DESC']);
    }
}