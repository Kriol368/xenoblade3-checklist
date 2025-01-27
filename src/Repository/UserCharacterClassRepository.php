<?php

namespace App\Repository;

use App\Entity\UserCharacterClass;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserCharacterClass>
 *
 * @method UserCharacterClass|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserCharacterClass|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserCharacterClass[]    findAll()
 * @method UserCharacterClass[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserCharacterClassRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserCharacterClass::class);
    }

//    /**
//     * @return UserCharacterClass[] Returns an array of UserCharacterClass objects
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

//    public function findOneBySomeField($value): ?UserCharacterClass
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
