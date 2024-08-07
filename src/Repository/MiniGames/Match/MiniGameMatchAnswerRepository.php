<?php

namespace App\Repository\MiniGames\Match;

use App\Entity\MiniGames\Match\MiniGameMatchAnswer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MiniGameMatchAnswer>
 *
 * @method MiniGameMatchAnswer|null find($id, $lockMode = null, $lockVersion = null)
 * @method MiniGameMatchAnswer|null findOneBy(array $criteria, array $orderBy = null)
 * @method MiniGameMatchAnswer[]    findAll()
 * @method MiniGameMatchAnswer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MiniGameMatchAnswerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MiniGameMatchAnswer::class);
    }

    /**
     * @return MiniGameMatchAnswer[] Returns an array of MiniGameMatchAnswer objects
     */
    public function findRandom(int $max): array
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.question IS NOT NULL')
            ->setMaxResults($max)
            ->orderBy('RAND()')
            ->getQuery()
            ->getResult()
            ;
    }

//    public function findOneBySomeField($value): ?MiniGameMatchAnswer
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
