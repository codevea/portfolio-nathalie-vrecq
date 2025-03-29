<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Project;
use App\Entity\Category;
use App\Entity\Settings;
use App\Entity\Monitoring;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class PagesController extends AbstractController
{
    public function __construct(private EntityManagerInterface $entityManagerInterface) {}

    #[Route('/projet-et-realisation', name: 'app_project', methods: ['GET'], schemes: ['https'])]
    public function project(): Response
    {

        return $this->render('pages/project.html.twig', [
            'setting' =>  $this->entityManagerInterface->getRepository(Settings::class)->findByIdSettings(),
            'projects' => $this->entityManagerInterface->getRepository(Project::class)->findAllProjects(),
            'categories' => $this->entityManagerInterface->getRepository(Category::class)->findAllCategoryField()
        ]);
    }

    #[Route('/Veille-et-technologie', name: 'app_monitoring', methods: ['GET'], schemes: ['https'])]
    public function monitoring(): Response
    {

        return $this->render('pages/monitoring.html.twig', [
            'monitorings' => $this->entityManagerInterface->getRepository(Monitoring::class)->findAllMonitoring(),
            'setting' => $this->entityManagerInterface->getRepository(Settings::class)->findByIdSettings()
        ]);
    }
}
