<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230528165145 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, product_group_id INT NOT NULL, code VARCHAR(100) NOT NULL, name VARCHAR(255) NOT NULL, gn_code VARCHAR(100) DEFAULT NULL, hs_code VARCHAR(100) DEFAULT NULL, tarif_code VARCHAR(100) DEFAULT NULL, is_liquid TINYINT(1) NOT NULL, brand VARCHAR(200) DEFAULT NULL, product_specification VARCHAR(255) DEFAULT NULL, created_at VARCHAR(255) DEFAULT NULL, updated_at VARCHAR(255) DEFAULT NULL, INDEX IDX_D34A04AD35E4B3D0 (product_group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_group (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(100) NOT NULL, name VARCHAR(200) NOT NULL, remarks VARCHAR(255) DEFAULT NULL, created_at VARCHAR(255) DEFAULT NULL, updated_at VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD35E4B3D0 FOREIGN KEY (product_group_id) REFERENCES product_group (id)');
        $this->addSql('DROP TABLE vat_number');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE vat_number (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD35E4B3D0');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_group');
    }
}
