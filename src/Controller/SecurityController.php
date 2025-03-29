<?php
declare(strict_types=1);


namespace App\Controller;

use App\Repository\SettingsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class SecurityController extends AbstractController
{
    #[Route(path: '/connexion', name: 'app_login', methods: ['GET', 'POST'], schemes: ['https'])]
    public function login(AuthenticationUtils $authenticationUtils, SettingsRepository $settingsRepository): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_home');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'setting' => $settingsRepository->findByIdSettings()
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout', methods: ['GET'], schemes: ['https'])]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
