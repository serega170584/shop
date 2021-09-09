<?php

namespace App\Controller;

use App\Entity\DigitalLineTest;
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
        var_dump(file_exists(__DIR__.'/AuthorController.php'));
        var_dump(opcache_is_script_cached(__DIR__.'/AuthorController.php'));
//        opcache_invalidate(__DIR__.'/AuthorController.php', true);
        var_dump(opcache_is_script_cached(__DIR__.'/AuthorController.php'));
        $group = $digitalLineTestGroupRepository->find(4);
        $subGroup = new DigitalLineTestSubGroup();
        $subGroup->setName('asdasd');
        $subGroup->setDigitalLineTestGroup($group);
        $this->getDoctrine()->getManager()->persist($subGroup);
        $this->getDoctrine()->getManager()->flush();
        $test = new DigitalLineTest();
        $test->setName('adasdasd');
        $test->setDigitalLineTestSubGroup($subGroup);
        $this->getDoctrine()->getManager()->persist($test);
        var_dump(count($group->getDigitalLineTestSubGroups()));
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
