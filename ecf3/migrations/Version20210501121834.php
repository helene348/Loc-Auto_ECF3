<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210501121834 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE agence (id INT AUTO_INCREMENT NOT NULL, agence_adresse LONGTEXT NOT NULL, agence_telephone VARCHAR(255) NOT NULL, agence_mail VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE assurance (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, assurance_prix_jour NUMERIC(10, 2) NOT NULL, assurance_date_prix DATE NOT NULL, INDEX IDX_386829AEBCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carburant (id INT AUTO_INCREMENT NOT NULL, carburant_nom VARCHAR(255) NOT NULL, carburant_prix NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, type_nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicule (id INT AUTO_INCREMENT NOT NULL, categories_id INT NOT NULL, agences_id INT NOT NULL, carburants_id INT NOT NULL, types_id INT NOT NULL, vehicule_immatriculation VARCHAR(255) NOT NULL, vehicule_modele VARCHAR(255) NOT NULL, vehicule_marque VARCHAR(255) NOT NULL, vehicule_equipements LONGTEXT DEFAULT NULL, vehicule_taille_reservoir INT NOT NULL, vehicule_date_achat DATE NOT NULL, vehicule_date_vente DATE DEFAULT NULL, INDEX IDX_292FFF1DA21214B7 (categories_id), INDEX IDX_292FFF1D9917E4AB (agences_id), INDEX IDX_292FFF1DDB408359 (carburants_id), INDEX IDX_292FFF1D8EB23357 (types_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE assurance ADD CONSTRAINT FK_386829AEBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1DA21214B7 FOREIGN KEY (categories_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1D9917E4AB FOREIGN KEY (agences_id) REFERENCES agence (id)');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1DDB408359 FOREIGN KEY (carburants_id) REFERENCES carburant (id)');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1D8EB23357 FOREIGN KEY (types_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD634A21214B7');
        $this->addSql('DROP INDEX IDX_497DD634A21214B7 ON categorie');
        $this->addSql('ALTER TABLE categorie CHANGE categories_id jours_id INT NOT NULL');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD6346180639B FOREIGN KEY (jours_id) REFERENCES jour (id)');
        $this->addSql('CREATE INDEX IDX_497DD6346180639B ON categorie (jours_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vehicule DROP FOREIGN KEY FK_292FFF1D9917E4AB');
        $this->addSql('ALTER TABLE vehicule DROP FOREIGN KEY FK_292FFF1DDB408359');
        $this->addSql('ALTER TABLE vehicule DROP FOREIGN KEY FK_292FFF1D8EB23357');
        $this->addSql('DROP TABLE agence');
        $this->addSql('DROP TABLE assurance');
        $this->addSql('DROP TABLE carburant');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE vehicule');
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD6346180639B');
        $this->addSql('DROP INDEX IDX_497DD6346180639B ON categorie');
        $this->addSql('ALTER TABLE categorie CHANGE jours_id categories_id INT NOT NULL');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD634A21214B7 FOREIGN KEY (categories_id) REFERENCES jour (id)');
        $this->addSql('CREATE INDEX IDX_497DD634A21214B7 ON categorie (categories_id)');
    }
}
