<?php 

namespace App\EventSubscriber;

use Twig\Environment;
use App\Repository\SettingsRepository;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Inject into the Twig views, globally across all pages of the application, the parameters stored in the Settings entity.
 */
class TwigGlobalSubscriber implements EventSubscriberInterface
{
    private $twig;
    private $settingsRepository;

    public function __construct(Environment $twig, SettingsRepository $settingsRepository)
    {
        $this->twig = $twig;
        $this->settingsRepository = $settingsRepository;
    }

    public function onKernelController(ControllerEvent $event): void
    {
        // Retrieve specific parameters from settingsRepository.
        $settings = $this->settingsRepository->findByIdSettings();

        // Check if the parameters exist.
        if ($settings) {
            $this->twig->addGlobal('setting', $settings);
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            ControllerEvent::class => 'onKernelController',
        ];
    }
}