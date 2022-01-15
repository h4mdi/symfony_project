<?php

namespace App\Repository;

use App\Entity\Calend;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Calend|null find($id, $lockMode = null, $lockVersion = null)
 * @method Calend|null findOneBy(array $criteria, array $orderBy = null)
 * @method Calend[]    findAll()
 * @method Calend[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CalendRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Calend::class);
    }

    // /**
    //  * @return Calend[] Returns an array of Calend objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Calend
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
