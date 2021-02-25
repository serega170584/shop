<?php

namespace App\Controller;

use App\Entity\Author;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorController extends AbstractController
{
    /**
     * @Route("/author", name="author")
     */
    public function new(Request $request): Response
    {
        $author = new Author();
        $form = $this->createForm(Author::class, $author);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $author = $form->getData();
            var_dump($author);
        }
        return $this->render('author/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}