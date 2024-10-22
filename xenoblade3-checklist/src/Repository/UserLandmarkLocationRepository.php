<?php

namespace App\Repository;

use App\Entity\UserLandmarkLocation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserLandmarkLocation>
 *
 * @method UserLandmarkLocation|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserLandmarkLocation|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserLandmarkLocation[]    findAll()
 * @method UserLandmarkLocation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserLandmarkLocationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserLandmarkLocation::class);
    }

//    /**
//     * @return UserLandmarkLocation[] Returns an array of UserLandmarkLocation objects
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

//    public function findOneBySomeField($value): ?UserLandmarkLocation
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
