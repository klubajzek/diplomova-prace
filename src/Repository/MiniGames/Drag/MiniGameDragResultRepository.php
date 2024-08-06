<?php

namespace App\Repository\MiniGames\Drag;

use App\Entity\MiniGames\Drag\MiniGameDragResult;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MiniGameDragResult>
 *
 * @method MiniGameDragResult|null find($id, $lockMode = null, $lockVersion = null)
 * @method MiniGameDragResult|null findOneBy(array $criteria, array $orderBy = null)
 * @method MiniGameDragResult[]    findAll()
 * @method MiniGameDragResult[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MiniGameDragResultRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MiniGameDragResult::class);
    }

//    /**
//     * @return MiniGameDragResult[] Returns an array of MiniGameDragResult objects
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

//    public function findOneBySomeField($value): ?MiniGameDragResult
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
