<?php

namespace App\Repository\Client\Planning;

use App\Entity\Client\Planning\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Index|null find($id, $lockMode = null, $lockVersion = null)
 * @method Index|null findOneBy(array $criteria, array $orderBy = null)
 * @method Index[]    findAll()
 * @method Index[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }

    public function findByIdSalarie($id)
    {
      $qb = $this->createQueryBuilder('e');
      $qb
          ->where('e.idUtilisateur = :id')
          ->setParameter('id', $id)
      ;

      return $qb
        ->getQuery()
        ->getResult()
      ;
    }

}
