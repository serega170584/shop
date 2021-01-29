<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     */
    public function index(Request $request): Response
    {
        echo $request->query->get('page');
        die('asd');
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
