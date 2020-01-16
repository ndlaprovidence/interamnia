<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200116155058 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, telephone INT DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, contact_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, cp INT NOT NULL, ville VARCHAR(255) NOT NULL, rue VARCHAR(255) NOT NULL, telephone INT DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, taille VARCHAR(255) DEFAULT NULL, activite VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_D19FA60E7A1254A (contact_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stage (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, date_debut VARCHAR(255) NOT NULL, date_fin VARCHAR(255) NOT NULL, classe_eleve VARCHAR(255) NOT NULL, theme VARCHAR(255) NOT NULL, commentaire VARCHAR(255) DEFAULT NULL, INDEX IDX_C27C9369A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbl_user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_38B383A1E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE entreprise ADD CONSTRAINT FK_D19FA60E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id)');
        $this->addSql('ALTER TABLE stage ADD CONSTRAINT FK_C27C9369A76ED395 FOREIGN KEY (user_id) REFERENCES tbl_user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE entreprise DROP FOREIGN KEY FK_D19FA60E7A1254A');
        $this->addSql('ALTER TABLE stage DROP FOREIGN KEY FK_C27C9369A76ED395');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('DROP TABLE stage');
        $this->addSql('DROP TABLE tbl_user');
    }
}
