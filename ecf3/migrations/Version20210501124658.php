<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210501124658 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, client_inscription DATE NOT NULL, client_role VARCHAR(255) NOT NULL, client_nom LONGTEXT NOT NULL, client_adresse LONGTEXT NOT NULL, client_mail VARCHAR(255) NOT NULL, client_telephone VARCHAR(255) DEFAULT NULL, client_login VARCHAR(255) NOT NULL, client_mdp VARCHAR(255) NOT NULL, client_numero_permis VARCHAR(255) NOT NULL, client_validite_permis DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reserver (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, vehicule_id INT NOT NULL, reservation_debut_prevu DATETIME NOT NULL, reservation_fin_prevue DATETIME NOT NULL, reservation_debut_effectif DATETIME NOT NULL, reservation_fin_effective DATETIME NOT NULL, reservation_km_debut BIGINT NOT NULL, reservation_km_fin BIGINT NOT NULL, reservation_reservoir_fin NUMERIC(10, 2) NOT NULL, INDEX IDX_B9765E9319EB6921 (client_id), INDEX IDX_B9765E934A4A3511 (vehicule_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reserver ADD CONSTRAINT FK_B9765E9319EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE reserver ADD CONSTRAINT FK_B9765E934A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id)');

        $this->addSql('ALTER TABLE Assurance DROP FOREIGN KEY FK_386829AEBCF5E72D');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reserver DROP FOREIGN KEY FK_B9765E9319EB6921');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE reserver');
    }
}
