<?php

namespace App\DataFixtures;

use App\Entity\City;
use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private readonly UserPasswordHasherInterface $hasher,
    ) {}

    public function load(ObjectManager $manager): void
    {
        #region User

        //Alice
        $alice = new User()
            ->setEmail("alice@example.fr")
            ->setCreatedAt(new \DateTimeImmutable());

        $hashedPassword = $this->hasher->hashPassword($alice, "motdepasse");
        $alice->setPassword($hashedPassword);

        $manager->persist($alice);

        //Bob
        $bob = new User()
            ->setEmail("bob@example.fr")
            ->setCreatedAt(new \DateTimeImmutable());

        $hashedPassword = $this->hasher->hashPassword($bob, "motdepasse");
        $bob->setPassword($hashedPassword);
        $manager->persist($bob);

        //Camille
        $camille = new User()
            ->setEmail("camille.aubert@example.fr")
            ->setFirstName("Camille")
            ->setLastName("Aubert")
            ->setCreatedAt(new \DateTimeImmutable("2026-02-04"));

        $hashedPassword = $this->hasher->hashPassword($camille, "motdepasse");
        $camille->setPassword($hashedPassword);
        $manager->persist($camille);

        #endregion User

        #region City

        $cities = [
            "Paris",
            "Lyon",
            "Marseille",
            "Bordeaux",
            "Lille",
            "Strasbourg",
            "Toulouse",
            "Nantes",
            "Dijon",
            "Brest",
        ];

        foreach ($cities as $cityName) {
            $city = new City()
                ->setName($cityName)
                ->setCreatedAt(new DateTimeImmutable());

            $manager->persist($city);
        }

        #endregion City

        $manager->flush();
    }
}
