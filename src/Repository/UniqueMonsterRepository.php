<?php

namespace App\Repository;

use App\Entity\UniqueMonster;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UniqueMonster>
 *
 * @method UniqueMonster|null find($id, $lockMode = null, $lockVersion = null)
 * @method UniqueMonster|null findOneBy(array $criteria, array $orderBy = null)
 * @method UniqueMonster[]    findAll()
 * @method UniqueMonster[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UniqueMonsterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UniqueMonster::class);
    }

//    /**
//     * @return UniqueMonster[] Returns an array of UniqueMonster objects
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

//    public function findOneBySomeField($value): ?UniqueMonster
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
