<?php

namespace App\Repository\User;

use App\Entity\Game\GameProfile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GameProfile>
 *
 * @method GameProfile|null find($id, $lockMode = null, $lockVersion = null)
 * @method GameProfile|null findOneBy(array $criteria, array $orderBy = null)
 * @method GameProfile[]    findAll()
 * @method GameProfile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameProfileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GameProfile::class);
    }

    /**
     * @return GameProfile[] Returns an array of GameProfile objects
     */
    public function getGameProfileStats(GameProfile $gameProfile): array
    {
        return $this->createQueryBuilder('g')
            ->select('sum(m.mistakes) as matchMistakes, count(m.id) as matchCount')
            ->leftJoin('g.miniGameMatchResults', 'm')
            ->andWhere('g.id = :profile')
            ->setParameter('profile', $gameProfile)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

//    public function findOneBySomeField($value): ?GameProfile
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
