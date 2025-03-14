<?php
namespace App\Repository\Client\Documents;

use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Doctrine\ORM\EntityRepository;

class ContratRepository extends EntityRepository implements UserLoaderInterface
{
    public function loadUserByUsername($username)
    {
        return $this->createQueryBuilder('u')
            ->where('u.username = :username OR u.email = :email')
            ->setParameter('username', $username)
            ->setParameter('email', $username)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /*
     * Récupérer les contrats liées à l'utilisateur "X"
     **/
    public function findByUtilisateur($id)
    {
      $qb = $this->createQueryBuilder('c');
      $qb
          ->where('c.utilisateur = :id')
          ->setParameter('id', $id)
      ;

      return $qb
        ->getQuery()
        ->getResult()
      ;
    }
}
