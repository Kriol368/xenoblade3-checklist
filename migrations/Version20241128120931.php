<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241128120931 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE soul_tree DROP FOREIGN KEY FK_CBB3B0DEFB281232');
        $this->addSql('DROP INDEX IDX_CBB3B0DEFB281232 ON soul_tree');
        $this->addSql('ALTER TABLE soul_tree CHANGE related_character_id character_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE soul_tree ADD CONSTRAINT FK_CBB3B0DE1136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id)');
        $this->addSql('CREATE INDEX IDX_CBB3B0DE1136BE75 ON soul_tree (character_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE soul_tree DROP FOREIGN KEY FK_CBB3B0DE1136BE75');
        $this->addSql('DROP INDEX IDX_CBB3B0DE1136BE75 ON soul_tree');
        $this->addSql('ALTER TABLE soul_tree CHANGE character_id related_character_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE soul_tree ADD CONSTRAINT FK_CBB3B0DEFB281232 FOREIGN KEY (related_character_id) REFERENCES `character` (id)');
        $this->addSql('CREATE INDEX IDX_CBB3B0DEFB281232 ON soul_tree (related_character_id)');
    }
}
