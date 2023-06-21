<?php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Symfony\Component\Uid\Uuid;

class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }

    public function save(Event $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Event $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getEventsList(){
        $queryBuilder = $this->createQueryBuilder('e')
            ->select('e.name, e.uuid, e.isCompleted, r.uuid')
            ->leftJoin('e.eventReport', 'r');

        return $queryBuilder->getQuery()->getArrayResult();
    }

    public function getByUuid(Uuid $uuid):Event {
        $event = $this->findOneBy(['uuid'=>$uuid]);
        if ($event === null) {
            throw new Exception('Event not found');
        }
        return $event;
    }
}
