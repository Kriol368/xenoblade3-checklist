<?php

namespace App\Repository;

use App\Entity\LandmarkLocation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LandmarkLocation>
 *
 * @method LandmarkLocation|null find($id, $lockMode = null, $lockVersion = null)
 * @method LandmarkLocation|null findOneBy(array $criteria, array $orderBy = null)
 * @method LandmarkLocation[]    findAll()
 * @method LandmarkLocation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LandmarkLocationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LandmarkLocation::class);
    }

//    /**
//     * @return LandmarkLocation[] Returns an array of LandmarkLocation objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?LandmarkLocation
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
