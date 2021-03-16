<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210315173547 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, author VARCHAR(255) DEFAULT NULL, create_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dog (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, birth DATE NOT NULL, breed VARCHAR(255) NOT NULL, breeder VARCHAR(255) NOT NULL, sex VARCHAR(255) NOT NULL, lof VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE litter (id INT AUTO_INCREMENT NOT NULL, dog_id INT NOT NULL, mom VARCHAR(255) NOT NULL, dad VARCHAR(255) NOT NULL, nb_female SMALLINT DEFAULT NULL, nb_male SMALLINT DEFAULT NULL, birth DATE NOT NULL, INDEX IDX_4BF2030B634DFEB (dog_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE litter ADD CONSTRAINT FK_4BF2030B634DFEB FOREIGN KEY (dog_id) REFERENCES dog (id)');
        $this->addSql('ALTER TABLE puppy ADD CONSTRAINT FK_31069F42128AEA69 FOREIGN KEY (litter_id) REFERENCES litter (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE litter DROP FOREIGN KEY FK_4BF2030B634DFEB');
        $this->addSql('ALTER TABLE puppy DROP FOREIGN KEY FK_31069F42128AEA69');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE dog');
        $this->addSql('DROP TABLE litter');
    }
}
