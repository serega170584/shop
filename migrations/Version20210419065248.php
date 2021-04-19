<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210419065248 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE session_order_item');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE session_order_item (id INT AUTO_INCREMENT NOT NULL, product_order_id INT NOT NULL, product_id INT NOT NULL, count INT NOT NULL, INDEX IDX_B27C1452462F07AF (product_order_id), INDEX IDX_B27C14524584665A (product_id), UNIQUE INDEX productOrder (product_id, product_order_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE session_order_item ADD CONSTRAINT FK_B27C14524584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE session_order_item ADD CONSTRAINT FK_B27C1452462F07AF FOREIGN KEY (product_order_id) REFERENCES `order` (id)');
    }
}
