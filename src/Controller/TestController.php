<?php

namespace App\Controller;

use App\Repository\DigitalLineTestGroupRepository;
use App\Repository\DigitalLineTestRepository;
use App\Repository\DigitalLineTestSubGroupRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     * @param DigitalLineTestSubGroupRepository $digitalLineTestSubGroupRepository
     * @param DigitalLineTestRepository $digitalLineTestRepository
     * @param DigitalLineTestGroupRepository $digitalLineTestGroupRepository
     * @return Response
     */
    public function index(DigitalLineTestSubGroupRepository $digitalLineTestSubGroupRepository, DigitalLineTestRepository $digitalLineTestRepository, DigitalLineTestGroupRepository $digitalLineTestGroupRepository): Response
    {
        $tests = $digitalLineTestRepository->findAll();
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
