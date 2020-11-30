<?php

namespace App\Controller;

use App\Entity\Album;
use App\Repository\AlbumRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\AlbumService;

class ReleasesController extends AbstractController
{

    private $albumRepository;

    public function __construct(AlbumRepository $albumRepository)
    {
        $this->albumRepository = $albumRepository;
    }

    /**
     * @Route(
     *     "/releases/{_locale}",
     *     name="releases",
     *     requirements={
     *         "_locale": "en|sr"
     *     },
     *     defaults={
     *         "_locale": "en"
     *     }
     * )
     *
     * @param AlbumService $albumService
     * @return Response
     */
    public function index(AlbumService $albumService): Response
    {
        $albums = $albumService->getAllPublicAlbums();

        return $this->render('releases.html.twig', ['albums' => $albums]);
    }

    /**
     * @Route("/api/albums/", name="import_albums", methods={"POST"})
     */
    public function add(Request $request): JsonResponse
    {
        $entityManager = $this->getDoctrine()->getManager();

        $data = json_decode($request->getContent(), true);

        $id = $data['id'];
        $name = $data['name'];
        $artist = $data['artist'];
        $public = $data['public'];
        $description = $data['description'];
        $code = $data['code'];
        $image = $data['image'];
        $release_date = $data['release_date'];

        if (
            empty($name) ||
            empty($artist) ||
            empty($public) ||
            empty($description) ||
            empty($code) ||
            empty($image) ||
            empty($release_date) ||
            empty($id)
        ) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $album = $this->albumRepository->findOneBy(['cid' => (int)$id]);
        if (!$album)
        {
            $album = new Album();
        }

        $album->setName($name);
        $album->setArtist($artist);
        $album->setPublic($public);
        $album->setDescription($description);
        $album->setCode($code);
        $album->setImage($image);
        $album->setReleaseDate(new \DateTime($release_date));

        $entityManager->persist($album);
        $entityManager->flush();

        return new JsonResponse(['status' => 'Albums imported'], Response::HTTP_CREATED);
    }
}
