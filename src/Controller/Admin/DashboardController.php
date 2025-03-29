<?php

namespace App\Controller\Admin;

use App\Entity\Skills;
use App\Entity\Project;
use App\Entity\Category;
use App\Entity\Settings;
use App\Entity\Timeline;
use App\Entity\Monitoring;
use Symfony\Component\HttpFoundation\Response;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
#[IsGranted('ROLE_ADMIN')]
class DashboardController extends AbstractDashboardController
{
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(ProjectCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Administration : Portfolio BTS SIO');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Paramètres', 'fa-solid fa-gear', Settings::class);
        yield MenuItem::linkToCrud('Projets', 'fa-solid fa-diagram-project', Project::class);
        yield MenuItem::linkToCrud('Catégories', 'fas fa-list', Category::class);
        yield MenuItem::linkToCrud('Timeline', 'fa-solid fa-timeline', Timeline::class);
        yield MenuItem::linkToCrud('Compétences', 'fa-solid fa-brain', Skills::class);
        yield MenuItem::linkToCrud('Veille', 'fa-brands fa-watchman-monitoring', Monitoring::class);
    }
}
