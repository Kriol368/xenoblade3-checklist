<?php

namespace App\Repository;

use App\Entity\ChallengeMode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ChallengeMode>
 *
 * @method ChallengeMode|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChallengeMode|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChallengeMode[]    findAll()
 * @method ChallengeMode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChallengeModeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChallengeMode::class);
    }

//    /**
//     * @return ChallengeMode[] Returns an array of ChallengeMode objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ChallengeMode
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
