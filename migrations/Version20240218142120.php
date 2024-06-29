<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240218142120 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE relation ADD subsidiary_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE relation ADD CONSTRAINT FK_62894749D4A7BDA2 FOREIGN KEY (subsidiary_id) REFERENCES subsidiary (id)');
        $this->addSql('CREATE INDEX IDX_62894749D4A7BDA2 ON relation (subsidiary_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE relation DROP FOREIGN KEY FK_62894749D4A7BDA2');
        $this->addSql('DROP INDEX IDX_62894749D4A7BDA2 ON relation');
        $this->addSql('ALTER TABLE relation DROP subsidiary_id');
    }
}
