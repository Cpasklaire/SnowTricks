<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221027015742 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, trick_relation_id INT DEFAULT NULL, created_user_id INT DEFAULT NULL, content LONGTEXT NOT NULL, created_ate DATETIME NOT NULL, INDEX IDX_9474526CBC61F632 (trick_relation_id), INDEX IDX_9474526CE104C1D3 (created_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, trick_relation_id INT DEFAULT NULL, created_user_id INT DEFAULT NULL, image_name VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, url VARCHAR(255) NOT NULL, type SMALLINT NOT NULL, created_ate DATETIME NOT NULL, INDEX IDX_6A2CA10CBC61F632 (trick_relation_id), INDEX IDX_6A2CA10CE104C1D3 (created_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trick (id INT AUTO_INCREMENT NOT NULL, created_user_id INT DEFAULT NULL, up_user_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, slug VARCHAR(50) NOT NULL, content LONGTEXT NOT NULL, created_ate DATETIME NOT NULL, up_dating DATETIME NOT NULL, category SMALLINT NOT NULL, INDEX IDX_D8F0A91EE104C1D3 (created_user_id), INDEX IDX_D8F0A91EB54D08FE (up_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, pseudo VARCHAR(50) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, created_ate DATETIME NOT NULL, avatar VARCHAR(255) DEFAULT NULL, token VARCHAR(255) DEFAULT NULL, activate TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D64986CC499D (pseudo), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CBC61F632 FOREIGN KEY (trick_relation_id) REFERENCES trick (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CE104C1D3 FOREIGN KEY (created_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CBC61F632 FOREIGN KEY (trick_relation_id) REFERENCES trick (id)');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CE104C1D3 FOREIGN KEY (created_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE trick ADD CONSTRAINT FK_D8F0A91EE104C1D3 FOREIGN KEY (created_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE trick ADD CONSTRAINT FK_D8F0A91EB54D08FE FOREIGN KEY (up_user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CBC61F632');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CE104C1D3');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10CBC61F632');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10CE104C1D3');
        $this->addSql('ALTER TABLE trick DROP FOREIGN KEY FK_D8F0A91EE104C1D3');
        $this->addSql('ALTER TABLE trick DROP FOREIGN KEY FK_D8F0A91EB54D08FE');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE trick');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
