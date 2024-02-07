<?php

namespace App\Controller\Admin;

use App\Entity\Email;
use App\Entity\Article;
use App\Entity\Contact;
use App\Entity\Category;
use App\Entity\PhoneNumber;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\Admin\CategoryCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/c2224&', name: 'admin')]
    public function index(): Response
    {

        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(CategoryCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('CouverturePlus')
            ->setFaviconPath("assets/img/favicon.png")
            ->setLocales(['fr', 'en']);
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Contact');
        yield MenuItem::linkToCrud('Demandes', 'fas fa-info-circle', Contact::class);
        yield MenuItem::section('Modifications');
        yield MenuItem::linkToCrud('Categories', 'fas fa-list', Category::class);
        yield MenuItem::linkToCrud('Articles', 'fas fa-info-circle', Article::class);
        yield MenuItem::linkToCrud('Numéros de téléphone', 'fas fa-phone', PhoneNumber::class);
        yield MenuItem::linkToCrud('Adresses e-mail', 'fas fa-envelope', Email::class);
    }
}
