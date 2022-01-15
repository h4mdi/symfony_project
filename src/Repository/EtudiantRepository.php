<?php

namespace App\Repository;

use App\Entity\Etudiant;
use App\Entity\Inscription;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Etudiant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Etudiant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Etudiant[]    findAll()
 * @method Etudiant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtudiantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Etudiant::class);
    }

    // /**
    //  * @return Etudiant[] Returns an array of Enseignant objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Enseignant
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    /**
     * @return Etudiant[]
     * @throws \Doctrine\DBAL\Exception
     */
    public function findEtudiantsLicence(): array
    {
        $conn = $this->getEntityManager()
            ->getConnection();
        $sql = "SELECT * FROM etudiant,classe where etudiant.id in (select inscription.etudiant_id from inscription where inscription.au='2021-2022') and classe.id= (select inscription.classe_id from inscription where inscription.au='2021-2022' ) and classe.specialite='Licence'  ";
        $stmt = $conn->prepare($sql);
       $result= $stmt->execute();
        $rows = $result->fetchAllAssociative();
       // var_dump($stmt->fetchAll());
        return $rows;



/*
        $em = $this->getEntityManager();
        $connection = $em->getConnection();
        $statement = $connection->prepare("SELECT * from etudiant where etudiant.id in (select inscription.etudiant_id from inscription )");
        $statement->execute();
        $results = $statement->fetchAll();

        return $results;*/

    }

    /**
     * @return Etudiant[]
     */
    public function findEtudiantsIngenieur(): array
    {
        $conn = $this->getEntityManager()
            ->getConnection();
        $sql = "SELECT * FROM etudiant,classe where etudiant.id in (select inscription.etudiant_id from inscription where inscription.au='2021-2022') and classe.id= (select inscription.classe_id from inscription where inscription.au='2021-2022' ) and classe.specialite='Ingenieur'  ";
        $stmt = $conn->prepare($sql);
        $result= $stmt->execute();
        $rows = $result->fetchAllAssociative();        // var_dump($stmt->fetchAll());
        return $rows;
        /*
                $em = $this->getEntityManager();
                $connection = $em->getConnection();
                $statement = $connection->prepare("SELECT * from etudiant where etudiant.id in (select inscription.etudiant_id from inscription )");
                $statement->execute();
                $results = $statement->fetchAll();

                return $results;*/

    }

}
