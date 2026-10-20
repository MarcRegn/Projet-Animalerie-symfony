<?php

namespace App\Repository;

use App\Entity\Animal;
use App\Enum\AnimalStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AnimalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Animal::class);
    }

    public function findAnimalsAvailable(): array
    {
        $query = $this->createQueryBuilder('a')
            ->andWhere('a.status = :status')
            ->setParameter('status', AnimalStatus::Available);

        return $query->getQuery()->getResult();
    }
}
