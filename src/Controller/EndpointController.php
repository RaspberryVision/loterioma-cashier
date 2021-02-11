<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EndpointController extends AbstractController
{
    /**
     * @Route("/endpoint", name="endpoint")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/EndpointController.php',
        ]);
    }

    /**
     * @Route("/pay-in", name="pay_in")
     */
    public function create(LoggerInterface  $logger): Response
    {
        $logger->info('ELO');
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/EndpointController.php',
        ]);
    }
}
