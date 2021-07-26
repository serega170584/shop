<?php


namespace App\Controller;


use App\Entity\Category;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category/{slug}", name="category")
     * @param Environment $twig
     * @param Category $category
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function show(Environment $twig, Category $category): Response
    {
        return new Response($twig->render('category/show.html.twig', [
            'title' => $category->getTitle(),
            'category' => $category,
            'products' => $this
                ->getDoctrine()
                ->getManager()
                ->getRepository(Product::class)
                ->findBy(['category' => $category], ['createdAt' => 'DESC']),
        ]));
    }

    /**
     * @Route("/category/list/{slug}", name="category-list")
     * @param Environment $twig
     * @param Category $category
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function listShow(Environment $twig, Category $category): Response
    {
        return new Response($twig->render('category/list-show.html.twig', [
            'title' => $category->getTitle(),
            'category' => $category,
            'products' => $this
                ->getDoctrine()
                ->getManager()
                ->getRepository(Product::class)
                ->findBy(['category' => $category], ['createdAt' => 'DESC']),
        ]));
    }
}