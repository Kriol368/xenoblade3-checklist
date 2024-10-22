<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241022073635 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_gauntlet_emblem (user_id INT NOT NULL, gauntlet_emblem_id INT NOT NULL, level INT NOT NULL, INDEX IDX_C7F99EC1A76ED395 (user_id), INDEX IDX_C7F99EC171CB3257 (gauntlet_emblem_id), PRIMARY KEY(user_id, gauntlet_emblem_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_gauntlet_emblem ADD CONSTRAINT FK_C7F99EC1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_gauntlet_emblem ADD CONSTRAINT FK_C7F99EC171CB3257 FOREIGN KEY (gauntlet_emblem_id) REFERENCES gauntlet_emblem (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_gauntlet_emblem DROP FOREIGN KEY FK_C7F99EC1A76ED395');
        $this->addSql('ALTER TABLE user_gauntlet_emblem DROP FOREIGN KEY FK_C7F99EC171CB3257');
        $this->addSql('DROP TABLE user_gauntlet_emblem');
    }
}
