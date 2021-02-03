<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\NewsService;
use App\Service\EventService;
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
     * @param EventService $eventService
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function index(
        NewsService $newsService,
        EventService $eventService,
        PaginatorInterface $paginator,
        Request $request
    ): Response
    {
        $news_pagination = $paginator->paginate(
            $newsService->getAllPublicNews(),
            $request->query->getInt('news_page', 1),
            5,
            array(
                'pageParameterName' => 'news_page',
            ),
        );

        $events_pagination = $paginator->paginate(
            $eventService->getAllPublicEvents(),
            $request->query->getInt('events_page', 1),
            5,
            array(
                'pageParameterName' => 'events_page',
            ),
        );

        return $this->render(
            'index.html.twig',
            [
                'news' => $news_pagination,
                'events' => $events_pagination,
            ]);
    }
}