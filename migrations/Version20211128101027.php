<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211128101027 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE puppy (id INT AUTO_INCREMENT NOT NULL, litter_id INT NOT NULL, name VARCHAR(255) NOT NULL, birth DATE NOT NULL, breed VARCHAR(255) NOT NULL, breeder VARCHAR(255) NOT NULL, sex VARCHAR(255) NOT NULL, INDEX IDX_31069F42128AEA69 (litter_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE puppy ADD CONSTRAINT FK_31069F42128AEA69 FOREIGN KEY (litter_id) REFERENCES litter (id)');
        $this->addSql('ALTER TABLE dog ADD filename VARCHAR(255) NOT NULL, ADD updated_at DATETIME NOT NULL, ADD puce VARCHAR(100) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE puppy');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE dog DROP filename, DROP updated_at, DROP puce');
    }
}
