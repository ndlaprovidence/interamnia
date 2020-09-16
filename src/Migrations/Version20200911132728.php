<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200911132728 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tbl_activiteentreprise (id INT AUTO_INCREMENT NOT NULL, activite VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbl_bts (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, specialisation VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbl_contact (id INT AUTO_INCREMENT NOT NULL, entreprise_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, INDEX IDX_1731EE4CA4AEAFEA (entreprise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbl_entreprise (id INT AUTO_INCREMENT NOT NULL, activite_id INT NOT NULL, nom VARCHAR(255) NOT NULL, region VARCHAR(255) NOT NULL, departement VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, code_postal VARCHAR(255) DEFAULT NULL, rue VARCHAR(255) NOT NULL, telephone VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, INDEX IDX_645AB0F19B0F88B1 (activite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbl_periode (id INT AUTO_INCREMENT NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbl_stage (id INT AUTO_INCREMENT NOT NULL, entreprise_id INT NOT NULL, user_id INT NOT NULL, bts_id INT NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, theme VARCHAR(255) NOT NULL, commentaire VARCHAR(255) DEFAULT NULL, INDEX IDX_6C18D976A4AEAFEA (entreprise_id), INDEX IDX_6C18D976A76ED395 (user_id), INDEX IDX_6C18D97618265AAD (bts_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbl_user (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(180) DEFAULT NULL, login VARCHAR(255) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_38B383A1E7927C74 (email), UNIQUE INDEX UNIQ_38B383A1AA08CB10 (login), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tbl_contact ADD CONSTRAINT FK_1731EE4CA4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES tbl_entreprise (id)');
        $this->addSql('ALTER TABLE tbl_entreprise ADD CONSTRAINT FK_645AB0F19B0F88B1 FOREIGN KEY (activite_id) REFERENCES tbl_activiteentreprise (id)');
        $this->addSql('ALTER TABLE tbl_stage ADD CONSTRAINT FK_6C18D976A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES tbl_entreprise (id)');
        $this->addSql('ALTER TABLE tbl_stage ADD CONSTRAINT FK_6C18D976A76ED395 FOREIGN KEY (user_id) REFERENCES tbl_user (id)');
        $this->addSql('ALTER TABLE tbl_stage ADD CONSTRAINT FK_6C18D97618265AAD FOREIGN KEY (bts_id) REFERENCES tbl_bts (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tbl_entreprise DROP FOREIGN KEY FK_645AB0F19B0F88B1');
        $this->addSql('ALTER TABLE tbl_stage DROP FOREIGN KEY FK_6C18D97618265AAD');
        $this->addSql('ALTER TABLE tbl_contact DROP FOREIGN KEY FK_1731EE4CA4AEAFEA');
        $this->addSql('ALTER TABLE tbl_stage DROP FOREIGN KEY FK_6C18D976A4AEAFEA');
        $this->addSql('ALTER TABLE tbl_stage DROP FOREIGN KEY FK_6C18D976A76ED395');
        $this->addSql('DROP TABLE tbl_activiteentreprise');
        $this->addSql('DROP TABLE tbl_bts');
        $this->addSql('DROP TABLE tbl_contact');
        $this->addSql('DROP TABLE tbl_entreprise');
        $this->addSql('DROP TABLE tbl_periode');
        $this->addSql('DROP TABLE tbl_stage');
        $this->addSql('DROP TABLE tbl_user');
    }
}
