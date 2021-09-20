<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product/{slug}", name="product")
     * @param Product $product
     * @return Response
     */
    public function index(Product $product): Response
    {
        dump($product->getTitle());
        return $this->render('product/index.html.twig', [
            'product' => $product,
        ]);
    }
}
