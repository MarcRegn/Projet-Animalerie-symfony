<?php

namespace App\DataFixtures;

use App\Entity\Animal;
use App\Enum\AnimalStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $this->animal(
            $manager,
            'Milo',
            'milo',
            'Milo est un chien ',
            2,
            AnimalStatus::Available
        );

        $this->animal(
            $manager,
            'Luna',
            'luna',
            'Luna est calme ',
            4,
            AnimalStatus::Available
        );

        $this->animal(
            $manager,
            'Oscar',
            'oscar',
            'Oscar est en cours d’adoption',
            3,
            AnimalStatus::AdoptionPending
        );

        $this->animal(
            $manager,
            'Bella',
            'bella',
            'Bella est adoptée',
            5,
            AnimalStatus::Adopted
        );

        $manager->flush();
    }

    private function animal(
        ObjectManager $manager,
        string $name,
        string $slug,
        string $description,
        int $age,
        AnimalStatus $status
    ): Animal {
        $animal = new Animal();

        $animal->setName($name);
        $animal->setSlug($slug);
        $animal->setDescription($description);
        $animal->setAge($age);
        $animal->setStatus($status);

        $manager->persist($animal);

        return $animal;
    }
}
