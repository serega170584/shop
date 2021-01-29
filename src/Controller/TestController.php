<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     */
    public function index(): Response
    {
        var_dump($_SERVER['DOCUMENT_ROOT']);
        die('asd');
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
