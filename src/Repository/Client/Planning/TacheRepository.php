<?php
namespace App\Repository\Client\Planning;

use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Doctrine\ORM\EntityRepository;

class TacheRepository extends EntityRepository implements UserLoaderInterface
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

    public function findByClient($client)
    {
      $id = $user->getId();
      $qb = $this->createQueryBuilder('p');
      $qb
          ->where('p.client = :id')
          ->setParameter('id', $id)
      ;

      return $qb
        ->getQuery()
        ->getResult()
      ;
    }
}
