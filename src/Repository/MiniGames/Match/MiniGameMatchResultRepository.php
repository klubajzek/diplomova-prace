<?php

namespace App\Repository\MiniGames\Match;

use App\Entity\Game\GameProfile;
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

    public function getGameProfileStats(GameProfile $gameProfile): array
    {
        return $this->createQueryBuilder('m')
            ->select('SUM(m.mistakes) as mistakes, COUNT(m.id) as total, SUM(m.correctAnswers) as correctAnswers, sum(m.notFilled) as notFilled')
            ->andWhere('m.gameProfile = :profile')
            ->setParameter('profile', $gameProfile)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

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
