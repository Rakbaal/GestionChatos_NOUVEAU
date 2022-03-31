<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220329132051 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personne ADD per_tel_pro VARCHAR(10) DEFAULT NULL, CHANGE per_prenom per_prenom VARCHAR(38) DEFAULT NULL, CHANGE per_tel per_tel_perso VARCHAR(10) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personne ADD per_tel VARCHAR(10) DEFAULT NULL, DROP per_tel_perso, DROP per_tel_pro, CHANGE per_prenom per_prenom VARCHAR(38) NOT NULL');
    }
}
