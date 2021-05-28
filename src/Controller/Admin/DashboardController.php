<?php

namespace App\Controller\Admin;

use App\Entity\Author;
use App\Entity\Category;
use App\Entity\Event;
use App\Entity\News;
use App\Entity\Order;
use App\Entity\OrderStatus;
use App\Entity\Product;
use App\Entity\Video;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Shop');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Products', 'fa fa-home', Product::class);
        yield MenuItem::linkToCrud('Categories', 'fa fa-home', Category::class);
        yield MenuItem::linkToCrud('Authors', 'fa fa-home', Author::class);
        yield MenuItem::linkToCrud('News', 'fa fa-home', News::class);
        yield MenuItem::linkToCrud('Events', 'fa fa-home', Event::class);
        yield MenuItem::linkToCrud('Video', 'fa fa-home', Video::class);
        yield MenuItem::linkToCrud('Order statuses', 'fa fa-home', OrderStatus::class);
        yield MenuItem::linkToCrud('Orders', 'fa fa-home', Order::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
