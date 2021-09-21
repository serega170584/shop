<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

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

    /**
     * @Route("/test/test/{slug}/product/author/{author_slug}/buy", name="buy")
     * @ParamConverter("author", options={"mapping": {"author_slug": "slug"}})
     * @param Product $product
     * @param Author $author
     * @return Response
     */
    public function buy(Product $product, Author $author): Response
    {
        dump($product->getTitle());
        return $this->json(['test'=>123]);
//        return $this->render('product/index.html.twig', [
//            'product' => $product,
//        ]);
    }
}
