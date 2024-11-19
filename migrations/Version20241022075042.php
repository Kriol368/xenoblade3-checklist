<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241022075042 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_challenge_mode (user_id INT NOT NULL, challenge_mode_id INT NOT NULL, easy TINYINT(1) NOT NULL, normal TINYINT(1) NOT NULL, hard TINYINT(1) NOT NULL, INDEX IDX_F5E09F74A76ED395 (user_id), INDEX IDX_F5E09F749B75CACF (challenge_mode_id), PRIMARY KEY(user_id, challenge_mode_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_character_class (user_id INT NOT NULL, character_class_id INT NOT NULL, unlocked TINYINT(1) NOT NULL, ascended TINYINT(1) NOT NULL, noah TINYINT(1) NOT NULL, mio TINYINT(1) NOT NULL, eunie TINYINT(1) NOT NULL, taion TINYINT(1) NOT NULL, lanz TINYINT(1) NOT NULL, sena TINYINT(1) NOT NULL, INDEX IDX_1549272A76ED395 (user_id), INDEX IDX_1549272B201E281 (character_class_id), PRIMARY KEY(user_id, character_class_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_gem (user_id INT NOT NULL, gem_id INT NOT NULL, level INT NOT NULL, INDEX IDX_7246E73BA76ED395 (user_id), INDEX IDX_7246E73BA5AD5580 (gem_id), PRIMARY KEY(user_id, gem_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_landmark_location (user_id INT NOT NULL, landmark_location_id INT NOT NULL, `checked` TINYINT(1) NOT NULL, INDEX IDX_992E628CA76ED395 (user_id), INDEX IDX_992E628CBB52F0D8 (landmark_location_id), PRIMARY KEY(user_id, landmark_location_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_soul_tree (user_id INT NOT NULL, soul_tree_id INT NOT NULL, `checked` TINYINT(1) NOT NULL, INDEX IDX_CB533D3AA76ED395 (user_id), INDEX IDX_CB533D3A57FB914F (soul_tree_id), PRIMARY KEY(user_id, soul_tree_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_unique_monster (user_id INT NOT NULL, unique_monster_id INT NOT NULL, defeated TINYINT(1) NOT NULL, soul_hacked TINYINT(1) NOT NULL, ability_upgraded TINYINT(1) NOT NULL, INDEX IDX_99100425A76ED395 (user_id), INDEX IDX_99100425D9032FE9 (unique_monster_id), PRIMARY KEY(user_id, unique_monster_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_challenge_mode ADD CONSTRAINT FK_F5E09F74A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_challenge_mode ADD CONSTRAINT FK_F5E09F749B75CACF FOREIGN KEY (challenge_mode_id) REFERENCES challenge_mode (id)');
        $this->addSql('ALTER TABLE user_character_class ADD CONSTRAINT FK_1549272A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_character_class ADD CONSTRAINT FK_1549272B201E281 FOREIGN KEY (character_class_id) REFERENCES character_class (id)');
        $this->addSql('ALTER TABLE user_gem ADD CONSTRAINT FK_7246E73BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_gem ADD CONSTRAINT FK_7246E73BA5AD5580 FOREIGN KEY (gem_id) REFERENCES gem (id)');
        $this->addSql('ALTER TABLE user_landmark_location ADD CONSTRAINT FK_992E628CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_landmark_location ADD CONSTRAINT FK_992E628CBB52F0D8 FOREIGN KEY (landmark_location_id) REFERENCES landmark_location (id)');
        $this->addSql('ALTER TABLE user_soul_tree ADD CONSTRAINT FK_CB533D3AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_soul_tree ADD CONSTRAINT FK_CB533D3A57FB914F FOREIGN KEY (soul_tree_id) REFERENCES soul_tree (id)');
        $this->addSql('ALTER TABLE user_unique_monster ADD CONSTRAINT FK_99100425A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_unique_monster ADD CONSTRAINT FK_99100425D9032FE9 FOREIGN KEY (unique_monster_id) REFERENCES unique_monster (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_challenge_mode DROP FOREIGN KEY FK_F5E09F74A76ED395');
        $this->addSql('ALTER TABLE user_challenge_mode DROP FOREIGN KEY FK_F5E09F749B75CACF');
        $this->addSql('ALTER TABLE user_character_class DROP FOREIGN KEY FK_1549272A76ED395');
        $this->addSql('ALTER TABLE user_character_class DROP FOREIGN KEY FK_1549272B201E281');
        $this->addSql('ALTER TABLE user_gem DROP FOREIGN KEY FK_7246E73BA76ED395');
        $this->addSql('ALTER TABLE user_gem DROP FOREIGN KEY FK_7246E73BA5AD5580');
        $this->addSql('ALTER TABLE user_landmark_location DROP FOREIGN KEY FK_992E628CA76ED395');
        $this->addSql('ALTER TABLE user_landmark_location DROP FOREIGN KEY FK_992E628CBB52F0D8');
        $this->addSql('ALTER TABLE user_soul_tree DROP FOREIGN KEY FK_CB533D3AA76ED395');
        $this->addSql('ALTER TABLE user_soul_tree DROP FOREIGN KEY FK_CB533D3A57FB914F');
        $this->addSql('ALTER TABLE user_unique_monster DROP FOREIGN KEY FK_99100425A76ED395');
        $this->addSql('ALTER TABLE user_unique_monster DROP FOREIGN KEY FK_99100425D9032FE9');
        $this->addSql('DROP TABLE user_challenge_mode');
        $this->addSql('DROP TABLE user_character_class');
        $this->addSql('DROP TABLE user_gem');
        $this->addSql('DROP TABLE user_landmark_location');
        $this->addSql('DROP TABLE user_soul_tree');
        $this->addSql('DROP TABLE user_unique_monster');
    }
}
