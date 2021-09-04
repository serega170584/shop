<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210904040131 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE test_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE test_sub_group (id INT AUTO_INCREMENT NOT NULL, test_group_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_319B7B66B37D211 (test_group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE test_sub_group ADD CONSTRAINT FK_319B7B66B37D211 FOREIGN KEY (test_group_id) REFERENCES test_group (id)');
        $this->addSql('ALTER TABLE test ADD test_sub_group_id INT NOT NULL, CHANGE name name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE test ADD CONSTRAINT FK_D87F7E0C687DD72E FOREIGN KEY (test_sub_group_id) REFERENCES test_sub_group (id)');
        $this->addSql('CREATE INDEX IDX_D87F7E0C687DD72E ON test (test_sub_group_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE test_sub_group DROP FOREIGN KEY FK_319B7B66B37D211');
        $this->addSql('ALTER TABLE test DROP FOREIGN KEY FK_D87F7E0C687DD72E');
        $this->addSql('DROP TABLE test_group');
        $this->addSql('DROP TABLE test_sub_group');
        $this->addSql('DROP INDEX IDX_D87F7E0C687DD72E ON test');
        $this->addSql('ALTER TABLE test DROP test_sub_group_id, CHANGE name name TEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`');
    }
}
