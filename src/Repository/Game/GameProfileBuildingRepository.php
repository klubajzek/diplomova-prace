<?php

namespace App\Repository\Game;

use App\Entity\Game\GameProfileBuilding;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GameProfileBuilding>
 *
 * @method GameProfileBuilding|null find($id, $lockMode = null, $lockVersion = null)
 * @method GameProfileBuilding|null findOneBy(array $criteria, array $orderBy = null)
 * @method GameProfileBuilding[]    findAll()
 * @method GameProfileBuilding[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameProfileBuildingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GameProfileBuilding::class);
    }

//    /**
//     * @return GameProfileBuilding[] Returns an array of GameProfileBuilding objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?GameProfileBuilding
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
