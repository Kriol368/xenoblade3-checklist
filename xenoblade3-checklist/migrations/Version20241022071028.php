<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241022071028 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `character` (id INT AUTO_INCREMENT NOT NULL, class_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, img_index INT DEFAULT NULL, UNIQUE INDEX UNIQ_937AB034EA000B10 (class_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hero (id INT AUTO_INCREMENT NOT NULL, class_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, img_index VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_51CE6E86EA000B10 (class_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE soul_tree (id INT AUTO_INCREMENT NOT NULL, related_character_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, effect VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_CBB3B0DEFB281232 (related_character_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034EA000B10 FOREIGN KEY (class_id) REFERENCES character_class (id)');
        $this->addSql('ALTER TABLE hero ADD CONSTRAINT FK_51CE6E86EA000B10 FOREIGN KEY (class_id) REFERENCES character_class (id)');
        $this->addSql('ALTER TABLE soul_tree ADD CONSTRAINT FK_CBB3B0DEFB281232 FOREIGN KEY (related_character_id) REFERENCES `character` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB034EA000B10');
        $this->addSql('ALTER TABLE hero DROP FOREIGN KEY FK_51CE6E86EA000B10');
        $this->addSql('ALTER TABLE soul_tree DROP FOREIGN KEY FK_CBB3B0DEFB281232');
        $this->addSql('DROP TABLE `character`');
        $this->addSql('DROP TABLE hero');
        $this->addSql('DROP TABLE soul_tree');
    }
}
