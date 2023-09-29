<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230929083821 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE property_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE property (id INT NOT NULL, profile_id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, description TEXT DEFAULT NULL, country VARCHAR(255) DEFAULT NULL, star INT DEFAULT NULL, website VARCHAR(255) DEFAULT NULL, adress VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8BF21CDECCFA12B8 ON property (profile_id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDECCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE property_id_seq CASCADE');
        $this->addSql('ALTER TABLE property DROP CONSTRAINT FK_8BF21CDECCFA12B8');
        $this->addSql('DROP TABLE property');
    }
}
