<?php

namespace App\Repository;

use App\Entity\Personne;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Fonction;
use PDO;

/**
 * @method Personne|null find($id, $lockMode = null, $lockVersion = null)
 * @method Personne|null findOneBy(array $criteria, array $orderBy = null)
 * @method Personne[]    findAll()
 * @method Personne[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Personne::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Personne $entity, bool $flush = true): void
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
    public function remove(Personne $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Personne[] Returns an array of Personne objects
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
    public function findOneBySomeField($value): ?Personne
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    
    /* Renvoie la liste  complète des entreprises */
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

    public function findByPersonneFiltre(Personne $data)
    {
        // Si les 3 textbox sont vides, alors on renvoit toutes les entreprises
        $nom = '';
        $prenom = '';

            // Si le textbox nom est null
            if (($holderNom = $data->getPERNOM()) != null) {
                $nom = $holderNom;
            }
    
            // Si le textbox prénom est null
            if (($holderPrenom = $data->getPERPRENOM()) != null) {
                $prenom = $holderPrenom;
            }

            // Les variables Q... permettent d'ajouter les % avant et après la valeur saisie
            $qNom = '%'.$nom.'%';
            $qPrenom = '%'.$prenom.'%';

        // Constitue la requête de filtrage avec 3 paramètres
        return $this->createQueryBuilder('p')
            ->andWhere('p.PER_NOM LIKE :nom')
            ->andWhere('p.PER_PRENOM LIKE :prenom')
            ->setParameter('nom', $qNom)          
            ->setParameter('prenom', $qPrenom)
            ->orderBy('p.PER_NOM', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
