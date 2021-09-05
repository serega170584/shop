<?php

namespace App\Controller;

use App\Entity\DigitalLineTest;
use App\Entity\DigitalLineTestGroup;
use App\Entity\DigitalLineTestSubGroup;
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
        $group = new DigitalLineTestGroup();
        $group->setName('asdasd');
        $this->getDoctrine()->getManager()->persist($group);
        $subGroup = new DigitalLineTestSubGroup();
        $subGroup->setName('asdasd');
        $subGroup->setDigitalLineTestGroup($group);
        $this->getDoctrine()->getManager()->persist($subGroup);
        $test = new DigitalLineTest();
        $test->setName('adasdasd');
        $test->setDigitalLineTestSubGroup($subGroup);
        $this->getDoctrine()->getManager()->persist($test);
        var_dump(count($subGroup->getDigitalLineTests()));
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
