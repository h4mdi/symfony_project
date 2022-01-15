<?php

namespace App\Repository;

use App\Entity\Pfe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Pfe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pfe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pfe[]    findAll()
 * @method Pfe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PfeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pfe::class);
    }

    // /**
    //  * @return Pfe[] Returns an array of Pfe objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Pfe
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
