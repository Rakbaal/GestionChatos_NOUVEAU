<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220331084729 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, ent_rs VARCHAR(50) NOT NULL, ent_ville VARCHAR(50) NOT NULL, ent_pays VARCHAR(50) NOT NULL, ent_adresse VARCHAR(70) NOT NULL, ent_cp VARCHAR(5) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise_personne (entreprise_id INT NOT NULL, personne_id INT NOT NULL, INDEX IDX_5D1ECF6AA4AEAFEA (entreprise_id), INDEX IDX_5D1ECF6AA21BD112 (personne_id), PRIMARY KEY(entreprise_id, personne_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise_specialite (entreprise_id INT NOT NULL, specialite_id INT NOT NULL, INDEX IDX_4841672AA4AEAFEA (entreprise_id), INDEX IDX_4841672A2195E0F0 (specialite_id), PRIMARY KEY(entreprise_id, specialite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fonction (id INT AUTO_INCREMENT NOT NULL, fon_libelle VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne (id INT AUTO_INCREMENT NOT NULL, per_nom VARCHAR(38) NOT NULL, per_prenom VARCHAR(38) DEFAULT NULL, per_mail VARCHAR(50) DEFAULT NULL, per_tel_perso VARCHAR(10) DEFAULT NULL, per_tel_pro VARCHAR(10) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne_profil (personne_id INT NOT NULL, profil_id INT NOT NULL, INDEX IDX_D2AC8A7AA21BD112 (personne_id), INDEX IDX_D2AC8A7A275ED078 (profil_id), PRIMARY KEY(personne_id, profil_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne_fonction (personne_id INT NOT NULL, fonction_id INT NOT NULL, INDEX IDX_CAD2D4F8A21BD112 (personne_id), INDEX IDX_CAD2D4F857889920 (fonction_id), PRIMARY KEY(personne_id, fonction_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profil (id INT AUTO_INCREMENT NOT NULL, pro_type VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specialite (id INT AUTO_INCREMENT NOT NULL, spe_libelle VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, uti_login VARCHAR(50) NOT NULL, uti_mdp VARCHAR(50) NOT NULL, uti_admin TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE entreprise_personne ADD CONSTRAINT FK_5D1ECF6AA4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entreprise_personne ADD CONSTRAINT FK_5D1ECF6AA21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entreprise_specialite ADD CONSTRAINT FK_4841672AA4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entreprise_specialite ADD CONSTRAINT FK_4841672A2195E0F0 FOREIGN KEY (specialite_id) REFERENCES specialite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personne_profil ADD CONSTRAINT FK_D2AC8A7AA21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personne_profil ADD CONSTRAINT FK_D2AC8A7A275ED078 FOREIGN KEY (profil_id) REFERENCES profil (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personne_fonction ADD CONSTRAINT FK_CAD2D4F8A21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personne_fonction ADD CONSTRAINT FK_CAD2D4F857889920 FOREIGN KEY (fonction_id) REFERENCES fonction (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entreprise_personne DROP FOREIGN KEY FK_5D1ECF6AA4AEAFEA');
        $this->addSql('ALTER TABLE entreprise_specialite DROP FOREIGN KEY FK_4841672AA4AEAFEA');
        $this->addSql('ALTER TABLE personne_fonction DROP FOREIGN KEY FK_CAD2D4F857889920');
        $this->addSql('ALTER TABLE entreprise_personne DROP FOREIGN KEY FK_5D1ECF6AA21BD112');
        $this->addSql('ALTER TABLE personne_profil DROP FOREIGN KEY FK_D2AC8A7AA21BD112');
        $this->addSql('ALTER TABLE personne_fonction DROP FOREIGN KEY FK_CAD2D4F8A21BD112');
        $this->addSql('ALTER TABLE personne_profil DROP FOREIGN KEY FK_D2AC8A7A275ED078');
        $this->addSql('ALTER TABLE entreprise_specialite DROP FOREIGN KEY FK_4841672A2195E0F0');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('DROP TABLE entreprise_personne');
        $this->addSql('DROP TABLE entreprise_specialite');
        $this->addSql('DROP TABLE fonction');
        $this->addSql('DROP TABLE personne');
        $this->addSql('DROP TABLE personne_profil');
        $this->addSql('DROP TABLE personne_fonction');
        $this->addSql('DROP TABLE profil');
        $this->addSql('DROP TABLE specialite');
        $this->addSql('DROP TABLE utilisateur');
    }
}
