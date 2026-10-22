<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function save(): void
    {
        $this->getEntityManager()->flush();
    }

    public function persist(User $user): void
    {
        $this->getEntityManager()->persist($user);
    }

    public function persistAndSave(User $user): void
    {
        $this->persist($user);
        $this->save();
    }
}
