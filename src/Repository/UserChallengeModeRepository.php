<?php

namespace App\Repository;

use App\Entity\UserChallengeMode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserChallengeMode>
 *
 * @method UserChallengeMode|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserChallengeMode|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserChallengeMode[]    findAll()
 * @method UserChallengeMode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserChallengeModeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserChallengeMode::class);
    }

//    /**
//     * @return UserChallengeMode[] Returns an array of UserChallengeMode objects
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

//    public function findOneBySomeField($value): ?UserChallengeMode
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
