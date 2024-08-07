<?php

namespace App\Repository\MiniGames\Match;

use App\Entity\MiniGames\Match\MiniGameMatchResultItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MiniGameMatchResultItem>
 *
 * @method MiniGameMatchResultItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method MiniGameMatchResultItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method MiniGameMatchResultItem[]    findAll()
 * @method MiniGameMatchResultItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MiniGameMatchResultItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MiniGameMatchResultItem::class);
    }

//    /**
//     * @return MiniGameMatchMistake[] Returns an array of MiniGameMatchMistake objects
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

//    public function findOneBySomeField($value): ?MiniGameMatchMistake
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
