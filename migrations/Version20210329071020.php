<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210329071020 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE author ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX title ON category');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_64C19C12B36786B ON category (title)');
        $this->addSql('ALTER TABLE product CHANGE is_popular is_popular TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE author DROP slug');
        $this->addSql('DROP INDEX uniq_64c19c12b36786b ON category');
        $this->addSql('CREATE UNIQUE INDEX title ON category (title)');
        $this->addSql('ALTER TABLE product CHANGE is_popular is_popular TINYINT(1) DEFAULT \'0\' NOT NULL');
    }
}
