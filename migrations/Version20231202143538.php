<?php

declare(strict_types=1);

/*
 * This file is part of Muneer's learning project.
 *
 * (c) Muneer shafi <mcamuneershafi@gmail.com>.
 */

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231202143538 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE subsidiary (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(100) NOT NULL, name VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, address VARCHAR(255) NOT NULL, zip_code VARCHAR(50) DEFAULT NULL, city VARCHAR(200) DEFAULT NULL, country VARCHAR(50) NOT NULL, website VARCHAR(100) DEFAULT NULL, abbreviation_name VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE relation_address RENAME INDEX idx_d4e6f813256915b TO IDX_14357DF03256915B');
        $this->addSql('ALTER TABLE relation_contact RENAME INDEX idx_4c62e6383256915b TO IDX_5519F4493256915B');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE subsidiary');
        $this->addSql('ALTER TABLE relation_contact RENAME INDEX idx_5519f4493256915b TO IDX_4C62E6383256915B');
        $this->addSql('ALTER TABLE relation_address RENAME INDEX idx_14357df03256915b TO IDX_D4E6F813256915B');
    }
}
