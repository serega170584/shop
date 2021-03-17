<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Product;
use App\Form\Type\ProductUploadType;
use EasyCorp\Bundle\EasyAdminBundle\Config\KeyValueStore;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\FieldDto;
use EasyCorp\Bundle\EasyAdminBundle\Factory\FormFactory;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\HiddenField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

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
            TextField::new('image')
                ->onlyOnForms()
                ->addJsFiles('/js/uploader.js'),
            ImageField::new('image')
                ->onlyOnIndex()
                ->setUploadDir('public/uploads/files')
                ->setBasePath('uploads/files'),
            AssociationField::new('category')->formatValue(function (string $s, Product $product) {
                return $product->getCategory()->getTitle();
            })->onlyOnIndex(),
            ChoiceField::new('category')->setChoices(function () {
                return ['asdasd' => 2, 'asdasdsdfsdf' => 3];
            })->setValue(function(){
                die('asd');
            })->onlyOnForms()
        ];
    }

    /**
     * @Route("/product/upload")
     */
    public function upload(Request $request, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(ProductUploadType::class);
        $form->handleRequest($request);
        $message = '';
        $newFilename = '';
        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('imageFile')->getData();
            /**
             * @var UploadedFile $imageFile
             */
            $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();
            try {
                $imageFile->move(
                    $this->getParameter('product_images_directory'),
                    $newFilename
                );
                $message = 'File is uploaded!';
            } catch (FileException $e) {
                $message = 'File upload error!';
            }
        }
        return $this->render('product/upload.html.twig', [
            'form' => $form->createView(),
            'message' => $message,
            'path' => $newFilename
        ]);
    }
}
