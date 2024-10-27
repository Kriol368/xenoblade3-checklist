<?php

namespace App\Repository;

use App\Entity\GauntletEmblem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GauntletEmblem>
 *
 * @method GauntletEmblem|null find($id, $lockMode = null, $lockVersion = null)
 * @method GauntletEmblem|null findOneBy(array $criteria, array $orderBy = null)
 * @method GauntletEmblem[]    findAll()
 * @method GauntletEmblem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GauntletEmblemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GauntletEmblem::class);
    }

//    /**
//     * @return GauntletEmblem[] Returns an array of GauntletEmblem objects
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

//    public function findOneBySomeField($value): ?GauntletEmblem
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
