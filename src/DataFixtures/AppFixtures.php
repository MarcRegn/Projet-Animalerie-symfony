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
            'Milo est un animal affectueux et joueur qui cherche une famille aimante.',
            2,
            AnimalStatus::Available
        );

        $this->animal(
            $manager,
            'Luna',
            'luna',
            'Luna est calme et apprécie la compagnie. Elle attend son futur foyer.',
            4,
            AnimalStatus::Available
        );

        $this->animal(
            $manager,
            'Oscar',
            'oscar',
            'Oscar est actuellement en cours d’adoption.',
            3,
            AnimalStatus::AdoptionPending
        );

        $this->animal(
            $manager,
            'Bella',
            'bella',
            'Bella a trouvé sa famille pour la vie.',
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
