<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211128140458 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dog ADD birthdate DATE NOT NULL, ADD microship INT DEFAULT NULL, ADD color VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE litter DROP FOREIGN KEY FK_4BF2030B634DFEB');
        $this->addSql('DROP INDEX IDX_4BF2030B634DFEB ON litter');
        $this->addSql('ALTER TABLE litter ADD name VARCHAR(255) DEFAULT NULL, DROP mom, CHANGE dog_id dog_mom_id INT NOT NULL, CHANGE birth birthdate DATE NOT NULL');
        $this->addSql('ALTER TABLE litter ADD CONSTRAINT FK_4BF2030B48AB7D11 FOREIGN KEY (dog_mom_id) REFERENCES dog (id)');
        $this->addSql('CREATE INDEX IDX_4BF2030B48AB7D11 ON litter (dog_mom_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dog DROP birthdate, DROP microship, DROP color');
        $this->addSql('ALTER TABLE litter DROP FOREIGN KEY FK_4BF2030B48AB7D11');
        $this->addSql('DROP INDEX IDX_4BF2030B48AB7D11 ON litter');
        $this->addSql('ALTER TABLE litter ADD mom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP name, CHANGE dog_mom_id dog_id INT NOT NULL, CHANGE birthdate birth DATE NOT NULL');
        $this->addSql('ALTER TABLE litter ADD CONSTRAINT FK_4BF2030B634DFEB FOREIGN KEY (dog_id) REFERENCES dog (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_4BF2030B634DFEB ON litter (dog_id)');
    }
}
