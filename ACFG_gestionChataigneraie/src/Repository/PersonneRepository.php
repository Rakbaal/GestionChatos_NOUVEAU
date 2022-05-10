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
        $conn = $this->getEntityManager()->getConnection();
        $fonctionChoisie = 0;
        $profilChoisi = 0;

        // Si les 3 textbox sont vides, alors on renvoit toutes les entreprises
        if ($data == null) {
            $nom = '';
            $prenom = '';
            $idFonction = '';
            $idProfil = '';
        }
        // Si il y a au moins 1 textbox rempli
        else {
            // Si le textbox Nom est null
            if ($data->getPERNOM() == null) {
                $nom = '';
            }
            else {
                $nom = $data->getPERNOM();
            }
    
            // Si le textbox Prénom est null
            if ($data->getPERPRENOM() == null) {
                $prenom = '';
            }
            else {
                $prenom = $data->getPERPRENOM();
            }
    
            // Si la comboBox Fonction est null
            if ($data->getFonctions()[0] == null) {
                $fonctionChoisie = '';
            }
            else {
                $fonctions = $data->getFonctions();
                $fonctionChoisie = $fonctions[0]->getId();
            }

            // Si le comboBox Profil est null
            if ($data->getProfils()[0] == null) {
                $profilChoisi = '';
            }
            else {
                $profils = $data->getProfils();
                $profilChoisi = $profils[0]->getId();
            }

            // Les variables Q... permettent d'ajouter les % avant et/ou après la valeur saisie
            $qNom = '%'.$nom.'%';
            $qPrenom = '%'.$prenom.'%';
            $qFonction = '%'.$fonctionChoisie.'%';
            $qProfil = '%'.$profilChoisi.'%';
        }

        $sql = '
        SELECT P.id, PER_NOM, PER_PRENOM, PER_MAIL, PER_TEL_PERSO, PER_TEL_PRO, ENT_RS, PRO_TYPE, FON_LIBELLE
        FROM personne AS P
        INNER JOIN entreprise as E ON entreprise_id = E.id
        LEFT JOIN personne_profil as PP ON P.id = PP.personne_id
        LEFT JOIN profil as PR ON PP.profil_id = PR.id
        LEFT JOIN personne_fonction AS PF ON P.id = PF.personne_id
        LEFT JOIN fonction AS F ON F.id = PF.fonction_id
        WHERE PER_NOM LIKE :nom
        AND PER_PRENOM LIKE :prenom
        AND F.id LIKE :idFonction
        AND PR.id LIKE :idProfil
        ORDER BY PER_NOM;';
        $stmt = $conn->prepare($sql);
        $stmt->bindValue( ":nom", $qNom, PDO::PARAM_STR );
        $stmt->bindValue( ":prenom", $qPrenom, PDO::PARAM_STR );
        $stmt->bindValue( ":idFonction", $qFonction, PDO::PARAM_INT );
        $stmt->bindValue( ":idProfil", $qProfil, PDO::PARAM_INT );
        $resultSet = $stmt->executeQuery();

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    } 
}
