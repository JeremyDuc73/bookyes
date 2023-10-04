<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231004150030 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE bed_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE room_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE room_kind_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE bed (id INT NOT NULL, kind VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE bed_room (bed_id INT NOT NULL, room_id INT NOT NULL, PRIMARY KEY(bed_id, room_id))');
        $this->addSql('CREATE INDEX IDX_549F803C88688BB9 ON bed_room (bed_id)');
        $this->addSql('CREATE INDEX IDX_549F803C54177093 ON bed_room (room_id)');
        $this->addSql('CREATE TABLE room (id INT NOT NULL, room_kind_id INT NOT NULL, number INT NOT NULL, price INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_729F519BDC429049 ON room (room_kind_id)');
        $this->addSql('CREATE TABLE room_kind (id INT NOT NULL, kind VARCHAR(255) NOT NULL, people INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE bed_room ADD CONSTRAINT FK_549F803C88688BB9 FOREIGN KEY (bed_id) REFERENCES bed (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE bed_room ADD CONSTRAINT FK_549F803C54177093 FOREIGN KEY (room_id) REFERENCES room (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519BDC429049 FOREIGN KEY (room_kind_id) REFERENCES room_kind (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE property ALTER name SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE bed_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE room_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE room_kind_id_seq CASCADE');
        $this->addSql('ALTER TABLE bed_room DROP CONSTRAINT FK_549F803C88688BB9');
        $this->addSql('ALTER TABLE bed_room DROP CONSTRAINT FK_549F803C54177093');
        $this->addSql('ALTER TABLE room DROP CONSTRAINT FK_729F519BDC429049');
        $this->addSql('DROP TABLE bed');
        $this->addSql('DROP TABLE bed_room');
        $this->addSql('DROP TABLE room');
        $this->addSql('DROP TABLE room_kind');
        $this->addSql('ALTER TABLE property ALTER name DROP NOT NULL');
    }
}
