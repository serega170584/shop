<?php

namespace App\Controller;

use App\Entity\Category;
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
        $categories = $this->getDoctrine()->getManager()
            ->getRepository(Category::class);
        var_dump(get_class($categories));
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'category'
        ]);
    }
}
