<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210415112652 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, session_id VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_item (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, count INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_status (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_status_order (order_status_id INT NOT NULL, order_id INT NOT NULL, INDEX IDX_6B35602D7707B45 (order_status_id), INDEX IDX_6B356028D9F6D38 (order_id), PRIMARY KEY(order_status_id, order_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session_order_item (id INT AUTO_INCREMENT NOT NULL, product_order_id INT NOT NULL, count INT NOT NULL, INDEX IDX_B27C1452462F07AF (product_order_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session_order_item_product (session_order_item_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_35773F787E64D51E (session_order_item_id), INDEX IDX_35773F784584665A (product_id), PRIMARY KEY(session_order_item_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE order_status_order ADD CONSTRAINT FK_6B35602D7707B45 FOREIGN KEY (order_status_id) REFERENCES order_status (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_status_order ADD CONSTRAINT FK_6B356028D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE session_order_item ADD CONSTRAINT FK_B27C1452462F07AF FOREIGN KEY (product_order_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE session_order_item_product ADD CONSTRAINT FK_35773F787E64D51E FOREIGN KEY (session_order_item_id) REFERENCES session_order_item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE session_order_item_product ADD CONSTRAINT FK_35773F784584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_status_order DROP FOREIGN KEY FK_6B356028D9F6D38');
        $this->addSql('ALTER TABLE session_order_item DROP FOREIGN KEY FK_B27C1452462F07AF');
        $this->addSql('ALTER TABLE order_status_order DROP FOREIGN KEY FK_6B35602D7707B45');
        $this->addSql('ALTER TABLE session_order_item_product DROP FOREIGN KEY FK_35773F787E64D51E');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE order_item');
        $this->addSql('DROP TABLE order_status');
        $this->addSql('DROP TABLE order_status_order');
        $this->addSql('DROP TABLE session_order_item');
        $this->addSql('DROP TABLE session_order_item_product');
    }
}
