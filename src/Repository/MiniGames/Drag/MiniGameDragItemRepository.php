<?php

namespace App\Repository\MiniGames\Drag;

use App\Entity\MiniGames\Drag\MiniGameDragItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MiniGameDragItem>
 *
 * @method MiniGameDragItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method MiniGameDragItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method MiniGameDragItem[]    findAll()
 * @method MiniGameDragItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MiniGameDragItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MiniGameDragItem::class);
    }

    /**
     * @return MiniGameDragItem[] Returns an array of MiniGameMatchAnswer objects
     */
    public function findRandom(int $max): array
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.answer IS NOT NULL and (m.firstPart IS NOT NULL or m.secondPart IS NOT NULL)')
            ->setMaxResults($max)
            ->orderBy('RAND()')
            ->getQuery()
            ->getResult()
            ;
    }

//    /**
//     * @return MiniGameDragItem[] Returns an array of MiniGameDragItem objects
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

//    public function findOneBySomeField($value): ?MiniGameDragItem
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
