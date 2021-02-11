<?php

namespace App\DataFixtures;

use App\Entity\Game;
use App\Entity\GeneratorConfig;
use App\Entity\User;
use App\Entity\UserWallet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 15; $i++) {
            $user = new User();
            $user->setWallet(new UserWallet(1000));

            $manager->persist($user);
        }

        $manager->flush();
    }
}
