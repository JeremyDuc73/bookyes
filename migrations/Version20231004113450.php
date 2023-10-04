<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231004113450 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE equipment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE equipment (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE equipment_property (equipment_id INT NOT NULL, property_id INT NOT NULL, PRIMARY KEY(equipment_id, property_id))');
        $this->addSql('CREATE INDEX IDX_BB3198F8517FE9FE ON equipment_property (equipment_id)');
        $this->addSql('CREATE INDEX IDX_BB3198F8549213EC ON equipment_property (property_id)');
        $this->addSql('ALTER TABLE equipment_property ADD CONSTRAINT FK_BB3198F8517FE9FE FOREIGN KEY (equipment_id) REFERENCES equipment (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE equipment_property ADD CONSTRAINT FK_BB3198F8549213EC FOREIGN KEY (property_id) REFERENCES property (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE equipment_id_seq CASCADE');
        $this->addSql('ALTER TABLE equipment_property DROP CONSTRAINT FK_BB3198F8517FE9FE');
        $this->addSql('ALTER TABLE equipment_property DROP CONSTRAINT FK_BB3198F8549213EC');
        $this->addSql('DROP TABLE equipment');
        $this->addSql('DROP TABLE equipment_property');
    }
}
