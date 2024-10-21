<?php

namespace App\Repository;

use App\Entity\Gem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Gem>
 *
 * @method Gem|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gem|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gem[]    findAll()
 * @method Gem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gem::class);
    }

//    /**
//     * @return Gem[] Returns an array of Gem objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Gem
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
