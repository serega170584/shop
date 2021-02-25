<?php

namespace App\Controller;

use App\Entity\Author;
use App\Form\Type\AuthorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    /**
     * @Route("/author", name="author")
     */
    public function new(Request $request): Response
    {
        $author = new Author();
        $form = $this->createForm(AuthorType::class, $author);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $author = $form->getData();
            var_dump($author);
        }
        var_dump($form->createView());
        die('asd');
        return $this->render('author/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}