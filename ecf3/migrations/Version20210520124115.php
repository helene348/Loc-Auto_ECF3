<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210520124115 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie CHANGE assurance_id assurance_id INT NOT NULL');
        $this->addSql('ALTER TABLE client CHANGE client_role client_role LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
        $this->addSql('ALTER TABLE reserver CHANGE reservation_debut_effectif reservation_debut_effectif DATETIME DEFAULT NULL, CHANGE reservation_fin_effective reservation_fin_effective DATETIME DEFAULT NULL, CHANGE reservation_km_debut reservation_km_debut BIGINT DEFAULT NULL, CHANGE reservation_km_fin reservation_km_fin BIGINT DEFAULT NULL, CHANGE reservation_reservoir_fin reservation_reservoir_fin NUMERIC(10, 2) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie CHANGE assurance_id assurance_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE client CHANGE client_role client_role VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'\'\'["ROLE_USER"]\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE reserver CHANGE reservation_debut_effectif reservation_debut_effectif DATETIME NOT NULL, CHANGE reservation_fin_effective reservation_fin_effective DATETIME NOT NULL, CHANGE reservation_km_debut reservation_km_debut BIGINT NOT NULL, CHANGE reservation_km_fin reservation_km_fin BIGINT NOT NULL, CHANGE reservation_reservoir_fin reservation_reservoir_fin NUMERIC(10, 2) NOT NULL');
    }
}
