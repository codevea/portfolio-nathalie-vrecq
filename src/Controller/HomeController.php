<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Skills;
use App\Entity\Project;
use App\Entity\Settings;
use App\Entity\Timeline;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home', methods: ['GET'], schemes: ['https'])]
        public function index(EntityManagerInterface $entityManagerInterface): Response
    {

        return $this->render('home/index.html.twig', [
            'timelines' =>  $entityManagerInterface->getRepository(Timeline::class)->findAllTimelineAscDate(),
            'setting' =>  $entityManagerInterface->getRepository(Settings::class)->findByIdSettings(),
            'skills' =>   $entityManagerInterface->getRepository(Skills::class)->findAllSkills(),
            'projects' => $entityManagerInterface->getRepository(Project::class)->countAllResultProject(),
        ]);
    }
}
