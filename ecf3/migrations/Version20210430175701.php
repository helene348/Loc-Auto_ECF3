<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210430175701 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, categories_id INT NOT NULL, week_ends_id INT NOT NULL, categorie_type VARCHAR(255) NOT NULL, caution_prix NUMERIC(10, 2) NOT NULL, INDEX IDX_497DD634A21214B7 (categories_id), INDEX IDX_497DD6348326AFC (week_ends_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE week_end (id INT AUTO_INCREMENT NOT NULL, wk_prix NUMERIC(10, 2) NOT NULL, wk_km_prix NUMERIC(10, 2) NOT NULL, wk_debut DATETIME NOT NULL, wk_fin DATETIME NOT NULL, wk_date_prix DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD634A21214B7 FOREIGN KEY (jours_id) REFERENCES jour (id)');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD6348326AFC FOREIGN KEY (week_ends_id) REFERENCES week_end (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD6348326AFC');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE week_end');
    }
}
