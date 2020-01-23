<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200122135942 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tbl_entreprise (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, region VARCHAR(255) NOT NULL, departement VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, code_postal VARCHAR(255) DEFAULT NULL, rue VARCHAR(255) NOT NULL, telephone VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, activite VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbl_compterendu (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, entreprise_id INT NOT NULL, eleve_id INT NOT NULL, prof_id INT NOT NULL, classe_eleve VARCHAR(255) NOT NULL, date_debut VARCHAR(255) NOT NULL, date_fin VARCHAR(255) NOT NULL, theme VARCHAR(255) NOT NULL, commentaire VARCHAR(255) DEFAULT NULL, INDEX IDX_A8031AA6A76ED395 (user_id), INDEX IDX_A8031AA6A4AEAFEA (entreprise_id), INDEX IDX_A8031AA6A6CC7B2 (eleve_id), INDEX IDX_A8031AA6ABC1F7FE (prof_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbl_user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_38B383A1E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbl_eleve (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, bts VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbl_prof (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tbl_compterendu ADD CONSTRAINT FK_A8031AA6A76ED395 FOREIGN KEY (user_id) REFERENCES tbl_user (id)');
        $this->addSql('ALTER TABLE tbl_compterendu ADD CONSTRAINT FK_A8031AA6A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES tbl_entreprise (id)');
        $this->addSql('ALTER TABLE tbl_compterendu ADD CONSTRAINT FK_A8031AA6A6CC7B2 FOREIGN KEY (eleve_id) REFERENCES tbl_eleve (id)');
        $this->addSql('ALTER TABLE tbl_compterendu ADD CONSTRAINT FK_A8031AA6ABC1F7FE FOREIGN KEY (prof_id) REFERENCES tbl_prof (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tbl_compterendu DROP FOREIGN KEY FK_A8031AA6A4AEAFEA');
        $this->addSql('ALTER TABLE tbl_compterendu DROP FOREIGN KEY FK_A8031AA6A76ED395');
        $this->addSql('ALTER TABLE tbl_compterendu DROP FOREIGN KEY FK_A8031AA6A6CC7B2');
        $this->addSql('ALTER TABLE tbl_compterendu DROP FOREIGN KEY FK_A8031AA6ABC1F7FE');
        $this->addSql('DROP TABLE tbl_entreprise');
        $this->addSql('DROP TABLE tbl_compterendu');
        $this->addSql('DROP TABLE tbl_user');
        $this->addSql('DROP TABLE tbl_eleve');
        $this->addSql('DROP TABLE tbl_prof');
    }
}
