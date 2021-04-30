<?php


namespace App\Controller;


use App\Entity\Category;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category/{slug}", name="category")
     * @param Environment $twig
     * @param Category $category
     * @param ProductRepository $productRepository
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function show(Environment $twig, Category $category, ProductRepository $productRepository): Response
    {
        return new Response($twig->render('category/show.html.twig', [
            'title' => $category->getTitle(),
            'category' => $category,
            'products' => $productRepository->findBy(['category' => $category], ['createdAt' => 'DESC']),
        ]));
    }

    /**
     * @Route("/category/list/{slug}", name="category-list")
     * @param Environment $twig
     * @param Category $category
     * @param ProductRepository $productRepository
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function listShow(Environment $twig, Category $category, ProductRepository $productRepository): Response
    {
        return new Response($twig->render('category/list-show.html.twig', [
            'title' => $category->getTitle(),
            'category' => $category,
            'products' => $productRepository->findBy(['category' => $category], ['createdAt' => 'DESC']),
        ]));
    }
}