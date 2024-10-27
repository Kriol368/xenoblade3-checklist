<?php

namespace App\Repository;

use App\Entity\Collectible;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Collectible>
 *
 * @method Collectible|null find($id, $lockMode = null, $lockVersion = null)
 * @method Collectible|null findOneBy(array $criteria, array $orderBy = null)
 * @method Collectible[]    findAll()
 * @method Collectible[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CollectibleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Collectible::class);
    }

//    /**
//     * @return Collectible[] Returns an array of Collectible objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Collectible
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
