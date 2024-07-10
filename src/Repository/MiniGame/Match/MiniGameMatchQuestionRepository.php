<?php

namespace App\Repository\MiniGame\Match;

use App\Entity\MiniGames\Match\MiniGameMatchQuestion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MiniGameMatchQuestion>
 *
 * @method MiniGameMatchQuestion|null find($id, $lockMode = null, $lockVersion = null)
 * @method MiniGameMatchQuestion|null findOneBy(array $criteria, array $orderBy = null)
 * @method MiniGameMatchQuestion[]    findAll()
 * @method MiniGameMatchQuestion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MiniGameMatchQuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MiniGameMatchQuestion::class);
    }

//    /**
//     * @return MiniGameMatchQuestion[] Returns an array of MiniGameMatchQuestion objects
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

//    public function findOneBySomeField($value): ?MiniGameMatchQuestion
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
