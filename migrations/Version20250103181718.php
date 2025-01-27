<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250103181718 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE area (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, region_id INT DEFAULT NULL, INDEX IDX_D7943D6898260155 (region_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE art (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, recharge_type VARCHAR(255) DEFAULT NULL, effect VARCHAR(255) DEFAULT NULL, power_multiplier INT DEFAULT NULL, recharge DOUBLE PRECISION DEFAULT NULL, master_level INT DEFAULT NULL, img_index INT DEFAULT NULL, class_id INT DEFAULT NULL, INDEX IDX_FC35D654EA000B10 (class_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE challenge_mode (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, difficulty VARCHAR(255) DEFAULT NULL, waves INT DEFAULT NULL, level_restriction INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE `character` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, img_index INT DEFAULT NULL, class_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_937AB034EA000B10 (class_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE character_class (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, weapon VARCHAR(255) DEFAULT NULL, role VARCHAR(255) DEFAULT NULL, nation VARCHAR(255) DEFAULT NULL, offense VARCHAR(255) DEFAULT NULL, defense VARCHAR(255) DEFAULT NULL, healing VARCHAR(255) DEFAULT NULL, difficulty VARCHAR(255) DEFAULT NULL, img_index VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE collectible (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, rarity VARCHAR(255) DEFAULT NULL, location VARCHAR(255) DEFAULT NULL, img_index INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE end_game_accessory (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, effect VARCHAR(255) DEFAULT NULL, location VARCHAR(255) DEFAULT NULL, category VARCHAR(255) DEFAULT NULL, img_index INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE food (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, effects VARCHAR(255) DEFAULT NULL, duration INT DEFAULT NULL, location VARCHAR(255) DEFAULT NULL, img_index INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE gauntlet_emblem (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, rarity VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, effects VARCHAR(255) DEFAULT NULL, img_index INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE gem (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, effect VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE hero (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, img_index VARCHAR(255) DEFAULT NULL, class_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_51CE6E86EA000B10 (class_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE landmark_location (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, region_id INT DEFAULT NULL, area_id INT DEFAULT NULL, INDEX IDX_6131D9A798260155 (region_id), INDEX IDX_6131D9A7BD0F409C (area_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE quest (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, level INT DEFAULT NULL, summary VARCHAR(255) DEFAULT NULL, giver VARCHAR(255) DEFAULT NULL, prerequisites VARCHAR(255) DEFAULT NULL, rewards VARCHAR(255) DEFAULT NULL, chapter VARCHAR(255) DEFAULT NULL, region_id INT DEFAULT NULL, INDEX IDX_4317F81798260155 (region_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE region (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE skill (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, effect VARCHAR(255) DEFAULT NULL, master_level INT DEFAULT NULL, img_index INT DEFAULT NULL, class_id INT DEFAULT NULL, INDEX IDX_5E3DE477EA000B10 (class_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE soul_tree (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, effect VARCHAR(255) DEFAULT NULL, character_id INT DEFAULT NULL, INDEX IDX_CBB3B0DE1136BE75 (character_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE unique_monster (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, level INT DEFAULT NULL, location VARCHAR(255) DEFAULT NULL, soulhacker_ability VARCHAR(255) DEFAULT NULL, area_id INT DEFAULT NULL, INDEX IDX_F295DB7CBD0F409C (area_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE user_challenge_mode (easy TINYINT(1) NOT NULL, normal TINYINT(1) NOT NULL, hard TINYINT(1) NOT NULL, user_id INT NOT NULL, challenge_mode_id INT NOT NULL, INDEX IDX_F5E09F74A76ED395 (user_id), INDEX IDX_F5E09F749B75CACF (challenge_mode_id), PRIMARY KEY(user_id, challenge_mode_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE user_character_class (unlocked TINYINT(1) NOT NULL, ascended TINYINT(1) NOT NULL, noah TINYINT(1) NOT NULL, mio TINYINT(1) NOT NULL, eunie TINYINT(1) NOT NULL, taion TINYINT(1) NOT NULL, lanz TINYINT(1) NOT NULL, sena TINYINT(1) NOT NULL, user_id INT NOT NULL, character_class_id INT NOT NULL, INDEX IDX_1549272A76ED395 (user_id), INDEX IDX_1549272B201E281 (character_class_id), PRIMARY KEY(user_id, character_class_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE user_gauntlet_emblem (checked TINYINT(1) NOT NULL, user_id INT NOT NULL, gauntlet_emblem_id INT NOT NULL, INDEX IDX_C7F99EC1A76ED395 (user_id), INDEX IDX_C7F99EC171CB3257 (gauntlet_emblem_id), PRIMARY KEY(user_id, gauntlet_emblem_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE user_gem (checked TINYINT(1) NOT NULL, user_id INT NOT NULL, gem_id INT NOT NULL, INDEX IDX_7246E73BA76ED395 (user_id), INDEX IDX_7246E73BA5AD5580 (gem_id), PRIMARY KEY(user_id, gem_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE user_landmark_location (checked TINYINT(1) NOT NULL, user_id INT NOT NULL, landmark_location_id INT NOT NULL, INDEX IDX_992E628CA76ED395 (user_id), INDEX IDX_992E628CBB52F0D8 (landmark_location_id), PRIMARY KEY(user_id, landmark_location_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE user_quest (checked TINYINT(1) NOT NULL, user_id INT NOT NULL, quest_id INT NOT NULL, INDEX IDX_A1D5034FA76ED395 (user_id), INDEX IDX_A1D5034F209E9EF4 (quest_id), PRIMARY KEY(user_id, quest_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE user_soul_tree (checked TINYINT(1) NOT NULL, user_id INT NOT NULL, soul_tree_id INT NOT NULL, INDEX IDX_CB533D3AA76ED395 (user_id), INDEX IDX_CB533D3A57FB914F (soul_tree_id), PRIMARY KEY(user_id, soul_tree_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE user_unique_monster (defeated TINYINT(1) NOT NULL, soul_hacked TINYINT(1) NOT NULL, ability_upgraded TINYINT(1) NOT NULL, user_id INT NOT NULL, unique_monster_id INT NOT NULL, INDEX IDX_99100425A76ED395 (user_id), INDEX IDX_99100425D9032FE9 (unique_monster_id), PRIMARY KEY(user_id, unique_monster_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE area ADD CONSTRAINT FK_D7943D6898260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE art ADD CONSTRAINT FK_FC35D654EA000B10 FOREIGN KEY (class_id) REFERENCES character_class (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034EA000B10 FOREIGN KEY (class_id) REFERENCES character_class (id)');
        $this->addSql('ALTER TABLE hero ADD CONSTRAINT FK_51CE6E86EA000B10 FOREIGN KEY (class_id) REFERENCES character_class (id)');
        $this->addSql('ALTER TABLE landmark_location ADD CONSTRAINT FK_6131D9A798260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE landmark_location ADD CONSTRAINT FK_6131D9A7BD0F409C FOREIGN KEY (area_id) REFERENCES area (id)');
        $this->addSql('ALTER TABLE quest ADD CONSTRAINT FK_4317F81798260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE skill ADD CONSTRAINT FK_5E3DE477EA000B10 FOREIGN KEY (class_id) REFERENCES character_class (id)');
        $this->addSql('ALTER TABLE soul_tree ADD CONSTRAINT FK_CBB3B0DE1136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id)');
        $this->addSql('ALTER TABLE unique_monster ADD CONSTRAINT FK_F295DB7CBD0F409C FOREIGN KEY (area_id) REFERENCES area (id)');
        $this->addSql('ALTER TABLE user_challenge_mode ADD CONSTRAINT FK_F5E09F74A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_challenge_mode ADD CONSTRAINT FK_F5E09F749B75CACF FOREIGN KEY (challenge_mode_id) REFERENCES challenge_mode (id)');
        $this->addSql('ALTER TABLE user_character_class ADD CONSTRAINT FK_1549272A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_character_class ADD CONSTRAINT FK_1549272B201E281 FOREIGN KEY (character_class_id) REFERENCES character_class (id)');
        $this->addSql('ALTER TABLE user_gauntlet_emblem ADD CONSTRAINT FK_C7F99EC1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_gauntlet_emblem ADD CONSTRAINT FK_C7F99EC171CB3257 FOREIGN KEY (gauntlet_emblem_id) REFERENCES gauntlet_emblem (id)');
        $this->addSql('ALTER TABLE user_gem ADD CONSTRAINT FK_7246E73BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_gem ADD CONSTRAINT FK_7246E73BA5AD5580 FOREIGN KEY (gem_id) REFERENCES gem (id)');
        $this->addSql('ALTER TABLE user_landmark_location ADD CONSTRAINT FK_992E628CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_landmark_location ADD CONSTRAINT FK_992E628CBB52F0D8 FOREIGN KEY (landmark_location_id) REFERENCES landmark_location (id)');
        $this->addSql('ALTER TABLE user_quest ADD CONSTRAINT FK_A1D5034FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_quest ADD CONSTRAINT FK_A1D5034F209E9EF4 FOREIGN KEY (quest_id) REFERENCES quest (id)');
        $this->addSql('ALTER TABLE user_soul_tree ADD CONSTRAINT FK_CB533D3AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_soul_tree ADD CONSTRAINT FK_CB533D3A57FB914F FOREIGN KEY (soul_tree_id) REFERENCES soul_tree (id)');
        $this->addSql('ALTER TABLE user_unique_monster ADD CONSTRAINT FK_99100425A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_unique_monster ADD CONSTRAINT FK_99100425D9032FE9 FOREIGN KEY (unique_monster_id) REFERENCES unique_monster (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE area DROP FOREIGN KEY FK_D7943D6898260155');
        $this->addSql('ALTER TABLE art DROP FOREIGN KEY FK_FC35D654EA000B10');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB034EA000B10');
        $this->addSql('ALTER TABLE hero DROP FOREIGN KEY FK_51CE6E86EA000B10');
        $this->addSql('ALTER TABLE landmark_location DROP FOREIGN KEY FK_6131D9A798260155');
        $this->addSql('ALTER TABLE landmark_location DROP FOREIGN KEY FK_6131D9A7BD0F409C');
        $this->addSql('ALTER TABLE quest DROP FOREIGN KEY FK_4317F81798260155');
        $this->addSql('ALTER TABLE skill DROP FOREIGN KEY FK_5E3DE477EA000B10');
        $this->addSql('ALTER TABLE soul_tree DROP FOREIGN KEY FK_CBB3B0DE1136BE75');
        $this->addSql('ALTER TABLE unique_monster DROP FOREIGN KEY FK_F295DB7CBD0F409C');
        $this->addSql('ALTER TABLE user_challenge_mode DROP FOREIGN KEY FK_F5E09F74A76ED395');
        $this->addSql('ALTER TABLE user_challenge_mode DROP FOREIGN KEY FK_F5E09F749B75CACF');
        $this->addSql('ALTER TABLE user_character_class DROP FOREIGN KEY FK_1549272A76ED395');
        $this->addSql('ALTER TABLE user_character_class DROP FOREIGN KEY FK_1549272B201E281');
        $this->addSql('ALTER TABLE user_gauntlet_emblem DROP FOREIGN KEY FK_C7F99EC1A76ED395');
        $this->addSql('ALTER TABLE user_gauntlet_emblem DROP FOREIGN KEY FK_C7F99EC171CB3257');
        $this->addSql('ALTER TABLE user_gem DROP FOREIGN KEY FK_7246E73BA76ED395');
        $this->addSql('ALTER TABLE user_gem DROP FOREIGN KEY FK_7246E73BA5AD5580');
        $this->addSql('ALTER TABLE user_landmark_location DROP FOREIGN KEY FK_992E628CA76ED395');
        $this->addSql('ALTER TABLE user_landmark_location DROP FOREIGN KEY FK_992E628CBB52F0D8');
        $this->addSql('ALTER TABLE user_quest DROP FOREIGN KEY FK_A1D5034FA76ED395');
        $this->addSql('ALTER TABLE user_quest DROP FOREIGN KEY FK_A1D5034F209E9EF4');
        $this->addSql('ALTER TABLE user_soul_tree DROP FOREIGN KEY FK_CB533D3AA76ED395');
        $this->addSql('ALTER TABLE user_soul_tree DROP FOREIGN KEY FK_CB533D3A57FB914F');
        $this->addSql('ALTER TABLE user_unique_monster DROP FOREIGN KEY FK_99100425A76ED395');
        $this->addSql('ALTER TABLE user_unique_monster DROP FOREIGN KEY FK_99100425D9032FE9');
        $this->addSql('DROP TABLE area');
        $this->addSql('DROP TABLE art');
        $this->addSql('DROP TABLE challenge_mode');
        $this->addSql('DROP TABLE `character`');
        $this->addSql('DROP TABLE character_class');
        $this->addSql('DROP TABLE collectible');
        $this->addSql('DROP TABLE end_game_accessory');
        $this->addSql('DROP TABLE food');
        $this->addSql('DROP TABLE gauntlet_emblem');
        $this->addSql('DROP TABLE gem');
        $this->addSql('DROP TABLE hero');
        $this->addSql('DROP TABLE landmark_location');
        $this->addSql('DROP TABLE quest');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP TABLE skill');
        $this->addSql('DROP TABLE soul_tree');
        $this->addSql('DROP TABLE unique_monster');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_challenge_mode');
        $this->addSql('DROP TABLE user_character_class');
        $this->addSql('DROP TABLE user_gauntlet_emblem');
        $this->addSql('DROP TABLE user_gem');
        $this->addSql('DROP TABLE user_landmark_location');
        $this->addSql('DROP TABLE user_quest');
        $this->addSql('DROP TABLE user_soul_tree');
        $this->addSql('DROP TABLE user_unique_monster');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
