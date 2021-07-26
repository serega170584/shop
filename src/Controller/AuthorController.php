<?php


namespace App\Controller;


use App\Entity\Author;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class AuthorController extends AbstractController
{
    /**
     * @Route("/author/{slug}", name="author")
     * @param Environment $twig
     * @param Author $author
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function show(Environment $twig, Author $author): Response
    {
        return new Response($twig->render('author/show.html.twig', [
            'title' => $author->getTitle(),
            'author' => $author,
            'products' => $this->getDoctrine()
                ->getManager()
                ->getRepository(Product::class)
                ->findBy(['author' => $author], ['createdAt' => 'DESC']),
        ]));
    }

    /**
     * @Route("/author/list/{slug}", name="author-list")
     * @param Environment $twig
     * @param Author $author
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function listShow(Environment $twig, Author $author): Response
    {
        return new Response($twig->render('author/list-show.html.twig', [
            'title' => $author->getTitle(),
            'author' => $author,
            'products' => $this->getDoctrine()
                ->getManager()
                ->getRepository(Product::class)
                ->findBy(['author' => $author], ['createdAt' => 'DESC']),
        ]));
    }

    /**
     * @Route("/author/about/{slug}", name="about-author")
     * @param Author $author
     * @return Response
     */
    public function aboutAuthor(Author $author)
    {
        return $this->render('author/about.html.twig', [
            'author' => $author
        ]);
    }

    /**
     * @Route("/authors", name="authors")
     * @return Response
     */
    public function authors()
    {
        return $this->render('author/list.html.twig', [
            'title' => 'Преподаватели',
            'authors' => $this->getDoctrine()
                ->getManager()
                ->getRepository(Author::class)
                ->findAll()
        ]);
    }
}