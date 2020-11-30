<?php

namespace App\Controller;

use App\Entity\News;
use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\ORM\EntityManagerInterface;

class NewsController extends AbstractController
{
    private $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    /**
     * @Route("/api/news/", name="import_news", methods={"POST"})
     *
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function add(Request $request): JsonResponse
    {
        $entityManager = $this->getDoctrine()->getManager();

        $data = json_decode($request->getContent(), true);

        $id = $data['id'];
        $title = $data['title'];
        $text = $data['text'];
        $public = $data['public'];
        $language = $data['language'];
        $date_published = $data['date_published'];

        if (
            empty($title) ||
            empty($text) ||
            empty($public) ||
            empty($language) ||
            empty($date_published) ||
            empty($id)
        ) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $news = $this->newsRepository->findOneBy(['cid' => (int)$id]);
        if (!$news)
        {
            $news = new News();
        }

        $news->setTitle($title);
        $news->setText($text);
        $news->setPublic($public);
        $news->setLanguage($language);
        $news->setDatePublished(new \DateTime($date_published));

        $entityManager->persist($news);
        $entityManager->flush();

        return new JsonResponse(['status' => 'News imported'], Response::HTTP_CREATED);
    }
}
