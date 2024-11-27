<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241127110715 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE soul_tree DROP INDEX UNIQ_CBB3B0DEFB281232, ADD INDEX IDX_CBB3B0DEFB281232 (related_character_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE soul_tree DROP INDEX IDX_CBB3B0DEFB281232, ADD UNIQUE INDEX UNIQ_CBB3B0DEFB281232 (related_character_id)');
    }
}
