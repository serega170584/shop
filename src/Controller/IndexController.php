<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        /**
         * @var CategoryRepository $repository
         */
        $repository = $this->getDoctrine()->getManager()
            ->getRepository(Category::class);
        $categories = $repository->findLastRows(5);
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/popular", name="popular-products")
     */
    public function popular(): Response
    {
        /**
         * @var ProductRepository $repository
         */
        $repository = $this->getDoctrine()->getManager()
            ->getRepository(Product::class);
        $products = $repository->findPopular();
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'products' => $products
        ]);
    }
}
