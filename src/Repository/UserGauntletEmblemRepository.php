<?php

namespace App\Repository;

use App\Entity\UserGauntletEmblem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserGauntletEmblem>
 *
 * @method UserGauntletEmblem|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserGauntletEmblem|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserGauntletEmblem[]    findAll()
 * @method UserGauntletEmblem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserGauntletEmblemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserGauntletEmblem::class);
    }

//    /**
//     * @return UserGauntletEmblem[] Returns an array of UserGauntletEmblem objects
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

//    public function findOneBySomeField($value): ?UserGauntletEmblem
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
