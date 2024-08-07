<?php

namespace App\Repository\MiniGames\Drag;

use App\Entity\MiniGames\Drag\MiniGameDragResultItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MiniGameDragResultItem>
 *
 * @method MiniGameDragResultItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method MiniGameDragResultItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method MiniGameDragResultItem[]    findAll()
 * @method MiniGameDragResultItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MiniGameDragResultItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MiniGameDragResultItem::class);
    }

//    /**
//     * @return MiniGameDragResultItem[] Returns an array of MiniGameDragResultItem objects
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

//    public function findOneBySomeField($value): ?MiniGameDragResultItem
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
