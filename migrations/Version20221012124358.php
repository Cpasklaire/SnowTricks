<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221012124358 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE media DROP up_dating');
        $this->addSql('ALTER TABLE trick CHANGE created_user_id created_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD roles JSON NOT NULL, ADD avatar VARCHAR(255) DEFAULT NULL, CHANGE pseudo pseudo VARCHAR(180) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64986CC499D ON user (pseudo)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_8D93D64986CC499D ON user');
        $this->addSql('ALTER TABLE user DROP roles, DROP avatar, CHANGE pseudo pseudo VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE media ADD up_dating DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE trick CHANGE created_user_id created_user_id INT DEFAULT NULL');
    }
}
