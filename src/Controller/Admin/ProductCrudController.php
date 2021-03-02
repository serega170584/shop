<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return Crud::new()
            // this defines the pagination size for all CRUD controllers
            // (each CRUD controller can override this value if needed)
            ->setPaginatorPageSize(30);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
//            IdField::new('id'),
            TextField::new('title'),
            TextField::new('preview'),
            TextareaField::new('description'),
            TextField::new('price'),
            ImageField::new('image')
                ->setUploadDir('public/uploads/files')
                ->setBasePath('uploads/files')
                ->addJsFiles('/js/uploader.js')
//            TextEditorField::new('description'),
        ];
    }

    /**
     * @Route("/product/upload")
     */
    public function upload(Request $request): Response
    {
        die('asd');
//        $author = new Author();
//        $form = $this->createForm(AuthorType::class, $author);
//        $form->handleRequest($request);
//        if ($form->isSubmitted() && $form->isValid()) {
//            $author = $form->getData();
//            var_dump($author);
//        }
//        return $this->render('author/new.html.twig', [
//            'form' => $form->createView(),
//        ]);
    }

}
