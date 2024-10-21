<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241021165152 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gauntlet_emblem (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, rarity VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, effects VARCHAR(255) DEFAULT NULL, img_index INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE character_class CHANGE img_index img_index VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE gauntlet_emblem');
        $this->addSql('ALTER TABLE character_class CHANGE img_index img_index INT DEFAULT NULL');
    }
}
