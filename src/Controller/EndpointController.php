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
        return $this->json(
            [
                'message' => 'Welcome to your new controller!',
                'path' => 'src/Controller/EndpointController.php',
            ]
        );
    }

    /**
     * @Route("/pay-in", name="pay_in")
     */
    public function create(Request $request, EntityManagerInterface $entityManager, LoggerInterface $logger): Response
    {
        $data = json_decode($request->getContent(), true);
        $logger->info($request->getContent())   ;

        /** @var User $user */
        $user = $entityManager->getRepository(User::class)->find($data['gameId']);

        if ($user->getWallet()->getAmount() - $data['amount'] < 0) {
            // error
            return $this->json(
                [
                    'code' => 100,
                    'status' => 1,
                ]
            );
        }

        $transaction = new Transaction();
        $transaction
            ->setAmount($data['amount'])
            ->setType(2);

        $user->addTransaction($transaction);

        $user->getWallet()->setAmount($user->getWallet()->getAmount() - $data['amount']);

        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json(
            [
                'status' => 0,
                'transactionId' => $transaction->getId(),
                'wallet' => $user->getWallet()->getAmount()
            ]
        );
    }
}
