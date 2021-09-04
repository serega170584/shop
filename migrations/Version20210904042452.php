<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210904042452 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE test_sub_group DROP FOREIGN KEY FK_319B7B66B37D211');
        $this->addSql('CREATE TABLE digital_line_test (id INT AUTO_INCREMENT NOT NULL, digital_line_test_sub_group_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_B8DC4E81226A7C7A (digital_line_test_sub_group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE digital_line_test_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE digital_line_test_sub_group (id INT AUTO_INCREMENT NOT NULL, digital_line_test_group_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_91A7595F757A0DD (digital_line_test_group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE digital_line_test ADD CONSTRAINT FK_B8DC4E81226A7C7A FOREIGN KEY (digital_line_test_sub_group_id) REFERENCES digital_line_test_sub_group (id)');
        $this->addSql('ALTER TABLE digital_line_test_sub_group ADD CONSTRAINT FK_91A7595F757A0DD FOREIGN KEY (digital_line_test_group_id) REFERENCES digital_line_test_group (id)');
        $this->addSql('DROP TABLE test_group');
        $this->addSql('DROP TABLE test_sub_group');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE digital_line_test_sub_group DROP FOREIGN KEY FK_91A7595F757A0DD');
        $this->addSql('ALTER TABLE digital_line_test DROP FOREIGN KEY FK_B8DC4E81226A7C7A');
        $this->addSql('CREATE TABLE test_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE test_sub_group (id INT AUTO_INCREMENT NOT NULL, test_group_id INT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_319B7B66B37D211 (test_group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE test_sub_group ADD CONSTRAINT FK_319B7B66B37D211 FOREIGN KEY (test_group_id) REFERENCES test_group (id)');
        $this->addSql('DROP TABLE digital_line_test');
        $this->addSql('DROP TABLE digital_line_test_group');
        $this->addSql('DROP TABLE digital_line_test_sub_group');
    }
}
