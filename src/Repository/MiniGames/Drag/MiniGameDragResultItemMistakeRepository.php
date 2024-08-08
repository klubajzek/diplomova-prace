<?php

namespace App\Repository\MiniGames\Drag;

use App\Entity\MiniGames\Drag\MiniGameDragResultItemMistake;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MiniGameDragResultItemMistake>
 *
 * @method MiniGameDragResultItemMistake|null find($id, $lockMode = null, $lockVersion = null)
 * @method MiniGameDragResultItemMistake|null findOneBy(array $criteria, array $orderBy = null)
 * @method MiniGameDragResultItemMistake[]    findAll()
 * @method MiniGameDragResultItemMistake[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MiniGameDragResultItemMistakeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MiniGameDragResultItemMistake::class);
    }

//    /**
//     * @return MiniGameDragResultItemMistake[] Returns an array of MiniGameDragResultItemMistake objects
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

//    public function findOneBySomeField($value): ?MiniGameDragResultItemMistake
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
