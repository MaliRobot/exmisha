<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\NewsService;
use Knp\Component\Pager\PaginatorInterface;

class IndexController extends AbstractController
{
    /**
     * @Route(
     *     "/{_locale}",
     *     name="index",
     *     requirements={
     *         "_locale": "en|sr",
     *     },
     *     defaults={
     *         "_locale": "en"
     *     }
     * )
     *
     * @param NewsService $newsService
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function index(NewsService $newsService, PaginatorInterface $paginator, Request $request): Response
    {
        $pagination = $paginator->paginate(
            $newsService->getAllPublicNews(),
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('index.html.twig', ['news' => $pagination]);
    }
}