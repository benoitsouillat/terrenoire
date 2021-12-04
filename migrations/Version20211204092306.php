<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211204092306 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE litter ADD CONSTRAINT FK_4BF2030BABB1CE64 FOREIGN KEY (dad_id) REFERENCES dog (id)');
        $this->addSql('CREATE INDEX IDX_4BF2030BABB1CE64 ON litter (dad_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE litter DROP FOREIGN KEY FK_4BF2030BABB1CE64');
        $this->addSql('DROP INDEX IDX_4BF2030BABB1CE64 ON litter');
    }
}
