<?php

namespace App\Repository;

use App\Entity\SoulTree;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SoulTree>
 *
 * @method SoulTree|null find($id, $lockMode = null, $lockVersion = null)
 * @method SoulTree|null findOneBy(array $criteria, array $orderBy = null)
 * @method SoulTree[]    findAll()
 * @method SoulTree[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SoulTreeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SoulTree::class);
    }

//    /**
//     * @return SoulTree[] Returns an array of SoulTree objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?SoulTree
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
