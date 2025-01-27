<?php

namespace App\Repository;

use App\Entity\UserSoulTree;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserSoulTree>
 *
 * @method UserSoulTree|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserSoulTree|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserSoulTree[]    findAll()
 * @method UserSoulTree[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserSoulTreeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserSoulTree::class);
    }

//    /**
//     * @return UserSoulTree[] Returns an array of UserSoulTree objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?UserSoulTree
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
