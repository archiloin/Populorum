<?php
namespace App\Repository\Client\Conge;

use Doctrine\ORM\Query;
use App\Entity\Client\Conge\Absence;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class AbsenceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Absence::class);
    }

    /**
     * @param $id
     * @return Absence[]
     */
    public function findOneById($id): array
    {
        $qb = $this->createQueryBuilder('p')
            ->andWhere('p.id == :id')
            ->setParameter('id', $id)
            ->orderBy('p.id', 'ASC')
            ->getQuery();

        return $qb->execute();

        // Limiter a un résultat
        // $projet = $qb->setMaxResults(1)->getOneOrNullResult();
    }
}
