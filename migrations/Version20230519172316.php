<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230519172316 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, relation_id INT DEFAULT NULL, name VARCHAR(200) NOT NULL, address_line1 VARCHAR(255) DEFAULT NULL, address_line2 VARCHAR(255) DEFAULT NULL, pin_code VARCHAR(30) NOT NULL, city VARCHAR(255) NOT NULL, INDEX IDX_D4E6F813256915B (relation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, relation_id INT DEFAULT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, intials VARCHAR(50) NOT NULL, gender VARCHAR(50) NOT NULL, telephone VARCHAR(50) NOT NULL, email VARCHAR(100) NOT NULL, INDEX IDX_4C62E6383256915B (relation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE currency (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(50) NOT NULL, symbol VARCHAR(10) DEFAULT NULL, remarks VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE relation (id INT AUTO_INCREMENT NOT NULL, currency_id INT NOT NULL, name VARCHAR(200) NOT NULL, short_name VARCHAR(100) NOT NULL, coc_number VARCHAR(50) DEFAULT NULL, email VARCHAR(150) DEFAULT NULL, remarks VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_6289474938248176 (currency_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vat_number (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F813256915B FOREIGN KEY (relation_id) REFERENCES relation (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E6383256915B FOREIGN KEY (relation_id) REFERENCES relation (id)');
        $this->addSql('ALTER TABLE relation ADD CONSTRAINT FK_6289474938248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F813256915B');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E6383256915B');
        $this->addSql('ALTER TABLE relation DROP FOREIGN KEY FK_6289474938248176');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE currency');
        $this->addSql('DROP TABLE relation');
        $this->addSql('DROP TABLE vat_number');
    }
}
