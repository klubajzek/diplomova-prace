<?php

namespace App\Repository\User;

use App\Entity\Game\GameProfile;
use App\Entity\User\User;
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

    public function getStats(): array
    {
        return $this->createQueryBuilder('gp')
            ->leftJoin('gp.user', 'u')
            ->andWhere('u.isDeactivated = false and gp.totalScore > 0')
            ->orderBy('gp.totalScore', 'DESC')
            ->setMaxResults(30)
            ->getQuery()
            ->getResult()
        ;
    }

    public function getUserRank(User $user): int
    {
        $qb = $this->createQueryBuilder('gp')
            ->select('gp.id, gp.totalScore, (SELECT COUNT(gp2.id) FROM App\Entity\Game\GameProfile gp2 WHERE gp2.totalScore > gp.totalScore AND gp2.user != gp.user) AS rank')
            ->leftJoin('gp.user', 'u')
            ->andWhere('u.isDeactivated = false')
            ->andWhere('gp.user = :user and gp.totalScore > 0')
            ->setParameter('user', $user)
            ->getQuery();

        try {
            $result = $qb->getSingleResult();
        } catch (\Exception $e) {
            return -1;
        }

        return $result['rank'] + 1 ?? -1;
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
