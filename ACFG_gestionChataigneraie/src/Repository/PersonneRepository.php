<?php

namespace App\Repository;

use App\Entity\Personne;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Fonction;

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

    /** 
     * @return listeEntreprisesFiltre[] Returns an array of Entreprise objects
     */
    
    // public function findByPersonneFiltre($data)
    // {
    //     // Si les 3 texbox sont vides, alors on renvoit toutes les entreprises
    //     if ($data == null) {
    //         $nom = '';
    //         $prenom = '';
    //         $fonction = '';
    //     }
    //     // Si il y a au moins 1 texbox remplis
    //     else {
            
    //         if ($data->getPERNOM() == null) {
    //             $nom = '';
    //         }
    //         else {
    //             $nom = $data->getPERNOM();
    //         }
    
    //         if ($data->getPERPRENOM() == null) {
    //             $prenom = '';
    //         }
    //         else {
    //             $prenom = $data->getPERPRENOM();
    //         }

    //         if ($data->getFonctions() == null) {
    //             $fonction = '';
    //         }
    //         else {
    //             $fonction = $data->getFonctions();
    //         }

    //         // Les variables Q... permettent d'ajouter les % avant et après la valeur saisie
    //         $Qnom = $nom.'%';
    //         $Qprenom = $prenom.'%';
    //         $Qfonction = '%'.$fonction.'%';
    //     }

    //     // Constitue la requête de filtrage avec 3 paramètres
    //     return $this->createQueryBuilder('e')
    //         ->innerJoin('e.fonctions as f')
    //         ->andWhere('e.PER_NOM LIKE :nom')
    //         ->andWhere('e.PER_PRENOM LIKE :prenom')
    //         ->andWhere('f.FON_LIBELLE IN (:fonction)')
    //         ->setParameter('nom', $Qnom)          
    //         ->setParameter('prenom', $Qprenom)
    //         ->setParameter('nom', $Qfonction)
    //         ->orderBy('e.id', 'ASC')
    //         ->setMaxResults(100)
    //         ->getQuery()
    //         ->getResult()
    //     ;
    // }
    public function findByPersonneFiltre($data)
    {
        // // Si les 3 texbox sont vides, alors on renvoit toutes les entreprises
        // if ($data == null) {
        //     $nom = '';
        //     $prenom = '';
        //     $fonction = '';
        //     $profil = '';
        // }
        // // Si il y a au moins 1 texbox remplis
        // else {
            
        //     if ($data->getPERNOM() == null) {
        //         $nom = '';
        //     }
        //     else {
        //         $nom = $data->getPERNOM();
        //     }
    
        //     if ($data->getPERPRENOM() == null) {
        //         $prenom = '';
        //     }
        //     else {
        //         $prenom = $data->getPERPRENOM();
        //     }

        //     if ($data->getFonctions() == null) {
        //         $fonction = '';
        //     }
        //     else {
        //         $fonction = $data->getFonctions();
        //     }
        //     if ($data->getProfils() == null) {
        //         $profil = '';
        //     }
        //     else {
        //         $profil = $data->getProfils();
        //     }

        //     // Les variables Q... permettent d'ajouter les % avant et après la valeur saisie
        //     $Qnom = $nom.'%';
        //     $Qprenom = $prenom.'%';
        //     $Qfonction = '%'.$fonction.'%';
        //     $Qprofil = '%'.$profil.'%';
        // }


        // $conn = $this->getEntityManager()->getConnection();

        // $sql = '
        // SELECT P.id, PER_NOM, PER_PRENOM, PER_MAIL, PER_TEL_PERSO, ENT_RS, PRO_TYPE, FON_LIBELLE
        // FROM personne AS P
        //     INNER JOIN entreprise_personne as EP ON P.id = EP.personne_id
        //     INNER JOIN entreprise AS E ON EP.entreprise_id = E.id
        //     LEFT JOIN personne_profil as PP ON P.id = PP.personne_id
        //     LEFT JOIN profil as PR ON PP.profil_id = PR.id
        //     LEFT JOIN personne_fonction AS PF ON P.id = PF.personne_id
        //     LEFT JOIN fonction AS F ON F.id = PF.fonction_id
        // WHERE PER_NOM LIKE :nom
        // AND PER_PRENOM LIKE :prenom
        // AND F.id LIKE :idFonction
        // AND PR.id LIKE :idProfil
        // ORDER BY PER_NOM';
        // $stmt = $conn->prepare($sql);
        // $resultSet = $stmt->executeQuery(['nom' => $Qnom],['prenom' => $Qprenom],['fonction' => $Qfonction],['profil' => $Qprofil]);

        // // returns an array of arrays (i.e. a raw data set)
        // return $resultSet->fetchAllAssociative();

        $conn = $this->getEntityManager()->getConnection();

        // Si les 3 texbox sont vides, alors on renvoit toutes les entreprises
        if ($data == null) {
            $nom = '';
            $prenom = '';
            $idFonction = '';
            $idProfil = '';
        }
        // Si il y a au moins 1 texbox remplis
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
            if ($data->getFonctions() == null) {
                $idFonction = '';
            }
            else {
                $fonctionObjet = $data->getFonctions();
                foreach($fonctionObjet as $fonction)
                {
                   $idFonction = $fonction->getId();
                }
            }

            // Si le comboBox Profil est null
            if ($data->getProfils() == null) {
                $idProfil = '';
            }
            else {
                $profilObjet = $data->getProfils();
                foreach($profilObjet as $profil)
                {
                   $idProfil = $profil->getId();
                }
            }

            // Les variables Q... permettent d'ajouter les % avant et/ou après la valeur saisie
            $Qnom = $nom.'%';
            $Qprenom = $prenom.'%';
            $Qfonction = '%'.$idFonction.'%';
            $Qprofil = '%'.$idProfil.'%';
        }

        $sql = '
        SELECT P.id, PER_NOM, PER_PRENOM, PER_MAIL, PER_TEL_PERSO, ENT_RS, PRO_TYPE, FON_LIBELLE
        FROM personne AS P
        INNER JOIN entreprise_personne as EP ON P.id = EP.personne_id
        INNER JOIN entreprise AS E ON EP.entreprise_id = E.id
        LEFT JOIN personne_profil as PP ON P.id = PP.personne_id
        LEFT JOIN profil as PR ON PP.profil_id = PR.id
        LEFT JOIN personne_fonction AS PF ON P.id = PF.personne_id
        LEFT JOIN fonction AS F ON F.id = PF.fonction_id
        WHERE PER_NOM LIKE :nom
        AND PER_PRENOM LIKE :prenom
        AND F.id LIKE :idFonction
        AND PR.id LIKE :idProfil
        ORDER BY PER_NOM';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['nom' => $Qnom],['prenom' => $Qprenom],['idFonction' => $Qfonction],['idProfil' => $Qprofil]);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    } 
}
