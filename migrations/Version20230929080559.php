<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230929080559 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image DROP CONSTRAINT fk_c53d045fccfa12b8');
        $this->addSql('DROP INDEX uniq_c53d045fccfa12b8');
        $this->addSql('ALTER TABLE image DROP profile_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE image ADD profile_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT fk_c53d045fccfa12b8 FOREIGN KEY (profile_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uniq_c53d045fccfa12b8 ON image (profile_id)');
    }
}
