<?php

namespace App\Repository\Client\Profil;

use App\Entity\Client\Profil\Index;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Index|null find($id, $lockMode = null, $lockVersion = null)
 * @method Index|null findOneBy(array $criteria, array $orderBy = null)
 * @method Index[]    findAll()
 * @method Index[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IndexRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Index::class);
    }
}
