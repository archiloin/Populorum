<?php
namespace App\Repository\Admin\Projet;

use App\Entity\Admin\Projet\Evenement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class EvenementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, evenement::class);
    }

    /**
     * @param $id
     * @return Evenement[]
     */
    public function findOneById($id): array
    {
        $qb = $this->createQueryBuilder('e')
            ->andWhere('e.id == :id')
            ->setParameter('id', $id)
            ->orderBy('e.id', 'ASC')
            ->getQuery();

        return $qb->execute();

        // Limiter a un résultat
        // $projet = $qb->setMaxResults(1)->getOneOrNullResult();
    }

    public function findAll()
    {
        return $this->findBy(array('date' => 'ASC'));
    }
}
