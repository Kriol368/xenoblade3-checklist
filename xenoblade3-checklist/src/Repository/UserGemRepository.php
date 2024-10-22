<?php

namespace App\Repository;

use App\Entity\UserGem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserGem>
 *
 * @method UserGem|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserGem|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserGem[]    findAll()
 * @method UserGem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserGemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserGem::class);
    }

//    /**
//     * @return UserGem[] Returns an array of UserGem objects
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

//    public function findOneBySomeField($value): ?UserGem
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
