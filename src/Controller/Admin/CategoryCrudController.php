<?php


namespace App\Controller\Admin;


use App\Entity\Category;
use App\Form\Type\CategoryUploadType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Option\EA;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Routing\Annotation\Route;

class CategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Category::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return Crud::new()
            // this defines the pagination size for all CRUD controllers
            // (each CRUD controller can override this value if needed)
            ->setPaginatorPageSize(30);
    }

//    public function configureActions(Actions $actions): Actions
//    {
//        $actions->remove(Crud::PAGE_INDEX, Action::DELETE);
//        $delete = Action::new(Action::DELETE, false, 'fas fa-file-invoice')->displayIf(static function ($entity) {
//            return 1 == 1;
//        })->linkToRoute('new', function (Category $cat): array {
//            return ['id' => $cat->getId()];
//        });
//        return $actions->add(Crud::PAGE_INDEX, $delete);
//    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            TextField::new('image')
                ->onlyOnForms()
                ->addJsFiles('/js/category-uploader.js'),
            ImageField::new('image')
                ->onlyOnIndex()
                ->setUploadDir('public/uploads/category')
                ->setBasePath('uploads/category')
                ->setRequired(false)
        ];
    }

    /**
     * @Route("/category/upload")
     */
    public function upload(Request $request, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(CategoryUploadType::class);
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
                    $this->getParameter('category_images_directory'),
                    $newFilename
                );
                $message = 'File is uploaded!';
            } catch (FileException $e) {
                $message = 'File upload error!';
            }
        }
        return $this->render('category/upload.html.twig', [
            'form' => $form->createView(),
            'message' => $message,
            'path' => $newFilename
        ]);
    }

    public function detail(AdminContext $context)
    {
        return $this->redirect($this->get(AdminUrlGenerator::class)
            ->setAction(Action::EDIT)
            ->setEntityId($context->getEntity()->getPrimaryKeyValue())
            ->unset(EA::MENU_INDEX)
            ->unset(EA::SUBMENU_INDEX)
            ->includeReferrer()
            ->generateUrl());
    }
}