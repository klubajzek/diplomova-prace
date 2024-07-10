<?php

namespace App\Repository\MiniGames\Match;

use App\Entity\MiniGames\Match\MiniGameMatchResult;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MiniGameMatchResult>
 *
 * @method MiniGameMatchResult|null find($id, $lockMode = null, $lockVersion = null)
 * @method MiniGameMatchResult|null findOneBy(array $criteria, array $orderBy = null)
 * @method MiniGameMatchResult[]    findAll()
 * @method MiniGameMatchResult[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MiniGameMatchResultRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MiniGameMatchResult::class);
    }

//    /**
//     * @return MiniGameMatchResult[] Returns an array of MiniGameMatchResult objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MiniGameMatchResult
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
