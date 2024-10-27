<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241022065524 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE landmark_location (id INT AUTO_INCREMENT NOT NULL, region_id INT DEFAULT NULL, area_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, INDEX IDX_6131D9A798260155 (region_id), INDEX IDX_6131D9A7BD0F409C (area_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE landmark_location ADD CONSTRAINT FK_6131D9A798260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE landmark_location ADD CONSTRAINT FK_6131D9A7BD0F409C FOREIGN KEY (area_id) REFERENCES area (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE landmark_location DROP FOREIGN KEY FK_6131D9A798260155');
        $this->addSql('ALTER TABLE landmark_location DROP FOREIGN KEY FK_6131D9A7BD0F409C');
        $this->addSql('DROP TABLE landmark_location');
    }
}
