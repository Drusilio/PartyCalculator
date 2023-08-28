<?php

namespace App\Repository;

use App\Entity\Expenditure;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Uid\Uuid;

class ExpenditureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Expenditure::class);
    }

    public function save(Expenditure $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Expenditure $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getByUuid(Uuid $uuid): Expenditure
    {
        $expenditure = $this->findOneBy(['uuid' => $uuid]);
        if (null === $expenditure) {
            throw new \Exception('Expenditure not found');
        }

        return $expenditure;
    }
}
