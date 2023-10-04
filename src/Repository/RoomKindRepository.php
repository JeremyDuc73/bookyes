<?php

namespace App\Repository;

use App\Entity\RoomKind;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RoomKind>
 *
 * @method RoomKind|null find($id, $lockMode = null, $lockVersion = null)
 * @method RoomKind|null findOneBy(array $criteria, array $orderBy = null)
 * @method RoomKind[]    findAll()
 * @method RoomKind[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoomKindRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RoomKind::class);
    }

//    /**
//     * @return RoomKind[] Returns an array of RoomKind objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?RoomKind
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
