<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200115082540 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE stage (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, date_debut VARCHAR(255) NOT NULL, date_fin VARCHAR(255) NOT NULL, classe_eleve VARCHAR(255) NOT NULL, theme VARCHAR(255) NOT NULL, commentaire VARCHAR(255) DEFAULT NULL, INDEX IDX_C27C9369A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE stage ADD CONSTRAINT FK_C27C9369A76ED395 FOREIGN KEY (user_id) REFERENCES tbl_user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE stage');
    }
}
