<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{
    /**
     * @Route(
     *     "/about/{_locale}",
     *     name="about",
     *     requirements={
     *         "_locale": "en|sr"
     *     },
     *     defaults={
     *         "_locale": "en"
     *     }
     * )
     */
    public function index(): Response
    {
        return $this->render('about.html.twig');
    }
}
