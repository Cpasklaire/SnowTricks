<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221011194548 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, pseudo VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, created_ate DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CB46B9EE8');
        $this->addSql('DROP INDEX IDX_9474526CB46B9EE8 ON comment');
        $this->addSql('ALTER TABLE comment ADD trick_relation_id INT DEFAULT NULL, CHANGE trick_id_id created_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CBC61F632 FOREIGN KEY (trick_relation_id) REFERENCES trick (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CE104C1D3 FOREIGN KEY (created_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_9474526CBC61F632 ON comment (trick_relation_id)');
        $this->addSql('CREATE INDEX IDX_9474526CE104C1D3 ON comment (created_user_id)');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10CB46B9EE8');
        $this->addSql('DROP INDEX IDX_6A2CA10CB46B9EE8 ON media');
        $this->addSql('ALTER TABLE media ADD trick_relation_id INT DEFAULT NULL, CHANGE trick_id_id created_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CBC61F632 FOREIGN KEY (trick_relation_id) REFERENCES trick (id)');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CE104C1D3 FOREIGN KEY (created_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_6A2CA10CBC61F632 ON media (trick_relation_id)');
        $this->addSql('CREATE INDEX IDX_6A2CA10CE104C1D3 ON media (created_user_id)');
        $this->addSql('ALTER TABLE trick ADD created_user_id INT DEFAULT NULL, ADD up_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE trick ADD CONSTRAINT FK_D8F0A91EE104C1D3 FOREIGN KEY (created_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE trick ADD CONSTRAINT FK_D8F0A91EB54D08FE FOREIGN KEY (up_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D8F0A91EE104C1D3 ON trick (created_user_id)');
        $this->addSql('CREATE INDEX IDX_D8F0A91EB54D08FE ON trick (up_user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CE104C1D3');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10CE104C1D3');
        $this->addSql('ALTER TABLE trick DROP FOREIGN KEY FK_D8F0A91EE104C1D3');
        $this->addSql('ALTER TABLE trick DROP FOREIGN KEY FK_D8F0A91EB54D08FE');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CBC61F632');
        $this->addSql('DROP INDEX IDX_9474526CBC61F632 ON comment');
        $this->addSql('DROP INDEX IDX_9474526CE104C1D3 ON comment');
        $this->addSql('ALTER TABLE comment DROP trick_relation_id, CHANGE created_user_id trick_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CB46B9EE8 FOREIGN KEY (trick_id_id) REFERENCES trick (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_9474526CB46B9EE8 ON comment (trick_id_id)');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10CBC61F632');
        $this->addSql('DROP INDEX IDX_6A2CA10CBC61F632 ON media');
        $this->addSql('DROP INDEX IDX_6A2CA10CE104C1D3 ON media');
        $this->addSql('ALTER TABLE media DROP trick_relation_id, CHANGE created_user_id trick_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CB46B9EE8 FOREIGN KEY (trick_id_id) REFERENCES trick (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_6A2CA10CB46B9EE8 ON media (trick_id_id)');
        $this->addSql('DROP INDEX IDX_D8F0A91EE104C1D3 ON trick');
        $this->addSql('DROP INDEX IDX_D8F0A91EB54D08FE ON trick');
        $this->addSql('ALTER TABLE trick DROP created_user_id, DROP up_user_id');
    }
}
