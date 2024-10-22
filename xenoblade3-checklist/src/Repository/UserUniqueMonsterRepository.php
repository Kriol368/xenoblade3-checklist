<?php

namespace App\Repository;

use App\Entity\UserUniqueMonster;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserUniqueMonster>
 *
 * @method UserUniqueMonster|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserUniqueMonster|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserUniqueMonster[]    findAll()
 * @method UserUniqueMonster[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserUniqueMonsterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserUniqueMonster::class);
    }

//    /**
//     * @return UserUniqueMonster[] Returns an array of UserUniqueMonster objects
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

//    public function findOneBySomeField($value): ?UserUniqueMonster
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
