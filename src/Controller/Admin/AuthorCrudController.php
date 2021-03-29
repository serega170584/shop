<?php


namespace App\Controller\Admin;


use App\Entity\Author;
use App\Entity\Category;
use App\Form\Type\AuthorUploadType;
use App\Form\Type\CategoryUploadType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Option\EA;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Routing\Annotation\Route;

class AuthorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Author::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return Crud::new()
            // this defines the pagination size for all CRUD controllers
            // (each CRUD controller can override this value if needed)
            ->setPaginatorPageSize(30);
    }

    public function configureActions(Actions $actions): Actions
    {
        $actions->remove(Crud::PAGE_INDEX, Action::DELETE);
        $url = $this->get(AdminUrlGenerator::class)
            ->setAction(Action::DELETE)
            ->includeReferrer()
            ->generateUrl();
        $delete = Action::new(Action::DELETE)->displayIf(static function (Category $entity) {
            return !$entity->getProducts()->count();
        })->linkToRoute($url, function (Category $cat): array {
            return ['entityId' => $cat->getId()];
        });
        return $actions->add(Crud::PAGE_INDEX, $delete);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            TextField::new('image')
                ->onlyOnForms()
                ->addJsFiles('/js/author-uploader.js'),
            ImageField::new('image')
                ->onlyOnIndex()
                ->setUploadDir('public/uploads/author')
                ->setBasePath('uploads/author')
                ->setRequired(false),
        ];
    }

    /**
     * @Route("/category/upload")
     */
    public function upload(Request $request, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(AuthorUploadType::class);
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
                    $this->getParameter('author_images_directory'),
                    $newFilename
                );
                $message = 'File is uploaded!';
            } catch (FileException $e) {
                $message = 'File upload error!';
            }
        }
        return $this->render('author/upload.html.twig', [
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