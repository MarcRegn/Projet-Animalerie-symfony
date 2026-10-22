<?php

namespace App\DataFixtures;

use App\Entity\Animal;
use App\Entity\User;
use App\Enum\AnimalStatus;
use App\Enum\RoleUser;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private readonly UserPasswordHasherInterface $hasher
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $admin = $this->user(
            $manager,
            'admin',
            'admin@refuge.test',
            'azerty',
            [RoleUser::Admin->value]
        );

        $member = $this->user(
            $manager,
            'member',
            'member@refuge.test',
            'azerty',
            [RoleUser::Member->value]
        );

        $user = $this->user(
            $manager,
            'user',
            'user@refuge.test',
            'azerty',
            [RoleUser::User->value]
        );

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

    private function user(
        ObjectManager $manager,
        string $username,
        string $email,
        string $password,
        array $roles
    ): User {
        $user = new User();
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setRoles($roles);
        $user->setPassword(
            $this->hasher->hashPassword(
                $user,
                $password
            )
        );
        $manager->persist($user);

        return $user;
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
