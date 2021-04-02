<?php

namespace App\Controller\Admin;

use App\Entity\News;
use App\Form\Type\NewsUploadType;
use EasyCorp\Bundle\EasyAdminBundle\Config\KeyValueStore;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\FieldDto;
use EasyCorp\Bundle\EasyAdminBundle\Factory\FormFactory;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class NewsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return News::class;
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
            TextField::new('title'),
            TextEditorField::new('preview'),
            TextEditorField::new('description'),
            DateField::new('startsAt'),
            TextField::new('image')
                ->onlyOnForms()
                ->addJsFiles('/js/news-uploader.js'),
            ImageField::new('image')
                ->onlyOnIndex()
                ->setUploadDir('public/uploads/news')
                ->setBasePath('uploads/news'),
        ];
    }

    /**
     * @Route("/news/upload")
     */
    public function upload(Request $request, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(NewsUploadType::class);
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
                    $this->getParameter('news_images_directory'),
                    $newFilename
                );
                $message = 'File is uploaded!';
            } catch (FileException $e) {
                $message = 'File upload error!';
            }
        }
        return $this->render('news/upload.html.twig', [
            'form' => $form->createView(),
            'message' => $message,
            'path' => $newFilename
        ]);
    }
}
