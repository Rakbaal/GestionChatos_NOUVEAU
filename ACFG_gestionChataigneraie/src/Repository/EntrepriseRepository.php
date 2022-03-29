<?php

namespace App\Repository;

use App\Entity\Entreprise;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method Entreprise|null find($id, $lockMode = null, $lockVersion = null)
 * @method Entreprise|null findOneBy(array $criteria, array $orderBy = null)
 * @method Entreprise[]    findAll()
 * @method Entreprise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntrepriseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Entreprise::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Entreprise $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Entreprise $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function listeAllEntreprises(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT ent_id,	ent_rs, ent_ville, ent_pays, ent_adresse, ent_cp
             FROM entreprise'
        );

        // returns an array of Product objects
        return $query->getResult();
    }

    public function listeEntrepriseRaisonSociale($rs): array
    {
        /*
                $pdo = $this->getEntityManager();
                $query = 'SELECT ent_id, ent_rs, ent_ville, ent_pays, ent_adresse, ent_cp FROM entreprise WHERE ent_rs = :rs';
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':rs', $rs);
                $stmt->execute();

                return $stmt->fetch();
        */
        
        $entityManager = $this->getEntityManager();
        $sql = "SELECT ent_id,	ent_rs, ent_ville, ent_pays, ent_adresse, ent_cp
        FROM entreprise WHERE ent_rs = '".$rs."'";

        $query = $entityManager->createQuery($sql);

        // returns an array of Product objects
        return $query->getResult();


        /*

        $query = $entityManager->createQuery(
            "SELECT ent_id,	ent_rs, ent_ville, ent_pays, ent_adresse, ent_cp
             FROM entreprise
             WHERE ent_rs = :rs"
        );

        $query = conn->prepare($query);

        $query->execute();


        $connexion= $entityManager;
        $sql="SELECT ent_id,	ent_rs, ent_ville, ent_pays, ent_adresse, ent_cp
                FROM entreprise
                WHERE ent_rs = :rs";
        $stmt=$connexion->prepare($sql);
        $stmt->bindParam(':rs', $rs);
        $stmt->execute();

        $stmt = $this->getEntityManager()
                    ->getConnection()
                    ->prepare('SELECT ent_id,	ent_rs, ent_ville, ent_pays, ent_adresse, ent_cp
                                    FROM entreprise
                                        WHERE ent_rs = :rs');


        $stmt -> setParameter(':rs', $rs);
        //$stmt->bindValue('foobar ', 1);
        $stmt->execute();
        
        // returns an array of Product objects
        return $query->getResult();

        */
    }

    // /**
    //  * @return Entreprise[] Returns an array of Entreprise objects
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
    public function findOneBySomeField($value): ?Entreprise
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
