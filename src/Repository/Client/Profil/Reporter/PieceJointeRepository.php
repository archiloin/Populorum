<?php
namespace App\Repository\Client\Profil\Reporter;

use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Doctrine\ORM\EntityRepository;

class PieceJointeRepository extends EntityRepository implements UserLoaderInterface
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
     * Récupérer les pièces jointes liées à l'utilisateur
     **/
    public function findByUser($user)
    {
      $id = $user->getId();
      $qb = $this->createQueryBuilder('p');
      $qb
          ->where('p.idUtilisateur = :id')
          ->setParameter('id', $id)
      ;
      $qb->orderBy('p.updatedAt', 'ASC');

      return $qb
        ->getQuery()
        ->getResult()
      ;
    }
}
