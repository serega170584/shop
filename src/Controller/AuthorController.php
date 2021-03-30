<?php


namespace App\Controller;


use App\Entity\Author;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController
{
    /**
     * @Route("/author/{slug}", name="author")
     * @param Environment $twig
     * @param Author $author
     * @param ProductRepository $productRepository
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function show(Environment $twig, Author $author, ProductRepository $productRepository): Response
    {
        return new Response($twig->render('author/show.html.twig', [
            'title' => $author->getTitle(),
            'author' => $author,
            'products' => $productRepository->findBy(['author' => $author], ['createdAt' => 'DESC']),
        ]));
    }

    /**
     * @Route("/author/list/{slug}", name="author-list")
     * @param Environment $twig
     * @param Author $author
     * @param ProductRepository $productRepository
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function listShow(Environment $twig, Author $author, ProductRepository $productRepository): Response
    {
        return new Response($twig->render('author/list-show.html.twig', [
            'title' => $author->getTitle(),
            'author' => $author,
            'products' => $productRepository->findBy(['author' => $author], ['createdAt' => 'DESC']),
        ]));
    }

}