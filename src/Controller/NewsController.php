<?php

namespace App\Controller;

use App\Entity\News;
use App\Repository\NewsRepository;
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
     * @param NewsRepository $newsRepository
     * @return Response
     */
    public function newsList(NewsRepository $newsRepository): Response
    {
        return $this->render('news/list.html.twig', [
            'title'=> 'Новости',
            'newsList' => $newsRepository->findAll()
        ]);
    }
}
