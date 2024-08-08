<?php

namespace App\Repository\MiniGames\Drag;

use App\Entity\MiniGames\Drag\MiniGameDragResultItemCorrect;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MiniGameDragResultItemCorrect>
 *
 * @method MiniGameDragResultItemCorrect|null find($id, $lockMode = null, $lockVersion = null)
 * @method MiniGameDragResultItemCorrect|null findOneBy(array $criteria, array $orderBy = null)
 * @method MiniGameDragResultItemCorrect[]    findAll()
 * @method MiniGameDragResultItemCorrect[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MiniGameDragResultItemCorrectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MiniGameDragResultItemCorrect::class);
    }

//    /**
//     * @return MiniGameDragResultItemCorrect[] Returns an array of MiniGameDragResultItemCorrect objects
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

//    public function findOneBySomeField($value): ?MiniGameDragResultItemCorrect
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
