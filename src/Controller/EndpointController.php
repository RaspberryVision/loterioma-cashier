<?php

namespace App\Controller;

use App\Entity\Transaction;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);

        /** @var User $user */
        $user = $entityManager->getRepository(User::class)->find(1);

        $transaction = new Transaction();
        $transaction
            ->setAmount(100)
            ->setType(2);

        $user->addTransaction($transaction);

        $entityManager->persist($transaction);
        $entityManager->flush();

        return $this->json([
            'transactionId' => $transaction->getId(),
            'path' => 'src/Controller/EndpointController.php',
        ]);
    }
}
