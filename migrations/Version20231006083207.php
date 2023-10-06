<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231006083207 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE room DROP CONSTRAINT fk_729f519bdc429049');
        $this->addSql('DROP SEQUENCE room_kind_id_seq CASCADE');
        $this->addSql('DROP TABLE room_kind');
        $this->addSql('DROP INDEX idx_729f519bdc429049');
        $this->addSql('ALTER TABLE room DROP room_kind_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE room_kind_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE room_kind (id INT NOT NULL, kind VARCHAR(255) NOT NULL, people INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE room ADD room_kind_id INT NOT NULL');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT fk_729f519bdc429049 FOREIGN KEY (room_kind_id) REFERENCES room_kind (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_729f519bdc429049 ON room (room_kind_id)');
    }
}
