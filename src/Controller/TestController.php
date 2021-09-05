<?php

namespace App\Controller;

use App\Repository\DigitalLineTestGroupRepository;
use App\Repository\DigitalLineTestRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     * @param DigitalLineTestRepository $digitalLineTestRepository
     * @param DigitalLineTestGroupRepository $digitalLineTestGroupRepository
     * @return Response
     */
    public function index(DigitalLineTestRepository $digitalLineTestRepository, DigitalLineTestGroupRepository $digitalLineTestGroupRepository): Response
    {
        $tests = $digitalLineTestRepository->findAll();
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
