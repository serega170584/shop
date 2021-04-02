<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210402115510 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event CHANGE description description LONGTEXT NOT NULL, CHANGE preview preview LONGTEXT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3BAE0AA72B36786B ON event (title)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1DD399502B36786B ON news (title)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D34A04AD2B36786B ON product (title)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7CC7DA2C2B36786B ON video (title)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_3BAE0AA72B36786B ON event');
        $this->addSql('ALTER TABLE event CHANGE description description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE preview preview VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('DROP INDEX UNIQ_1DD399502B36786B ON news');
        $this->addSql('DROP INDEX UNIQ_D34A04AD2B36786B ON product');
        $this->addSql('DROP INDEX UNIQ_7CC7DA2C2B36786B ON video');
    }
}
