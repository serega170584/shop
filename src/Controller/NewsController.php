<?php

namespace App\Controller;

use App\Entity\News;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends AbstractController
{
    /**
     * @Route("/news/{slug}", name="news")
     * @param News $news
     * @return Response
     */
    public function index(News $news): Response
    {
        return $this->render('news/index.html.twig', [
            'news' => $news
        ]);
    }

    /**
     * @Route("/newsList", name="newsList")
     * @return Response
     */
    public function newsList(): Response
    {
        return $this->render('news/list.html.twig', [
            'title'=> 'Новости',
            'newsList' => $this->getDoctrine()
                ->getManager()
                ->getRepository(News::class)
                ->findAll()
        ]);
    }
}
