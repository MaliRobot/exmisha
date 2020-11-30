<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MediaController extends AbstractController
{
    /**
     * @Route(
     *     "/{_locale}/media",
     *     name="media",
     *     requirements={
     *         "_locale": "en|sr",
     *     },
     *     defaults={
     *         "_locale": "en"
     *     }
     * )
     */
    public function index(): Response
    {
        return $this->render('media.html.twig');
    }
}
