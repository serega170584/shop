<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210415121505 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE order_status_order');
        $this->addSql('DROP TABLE session_order_item_product');
        $this->addSql('ALTER TABLE `order` ADD order_status_id INT NOT NULL, DROP slug');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398D7707B45 FOREIGN KEY (order_status_id) REFERENCES order_status (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F5299398613FECDF ON `order` (session_id)');
        $this->addSql('CREATE INDEX IDX_F5299398D7707B45 ON `order` (order_status_id)');
        $this->addSql('ALTER TABLE order_item DROP slug');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B88F75C92B36786B ON order_status (title)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B88F75C9989D9B62 ON order_status (slug)');
        $this->addSql('ALTER TABLE session_order_item ADD product_id INT NOT NULL');
        $this->addSql('ALTER TABLE session_order_item ADD CONSTRAINT FK_B27C14524584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_B27C14524584665A ON session_order_item (product_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE order_status_order (order_status_id INT NOT NULL, order_id INT NOT NULL, INDEX IDX_6B35602D7707B45 (order_status_id), INDEX IDX_6B356028D9F6D38 (order_id), PRIMARY KEY(order_status_id, order_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE session_order_item_product (session_order_item_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_35773F787E64D51E (session_order_item_id), INDEX IDX_35773F784584665A (product_id), PRIMARY KEY(session_order_item_id, product_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE order_status_order ADD CONSTRAINT FK_6B356028D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_status_order ADD CONSTRAINT FK_6B35602D7707B45 FOREIGN KEY (order_status_id) REFERENCES order_status (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE session_order_item_product ADD CONSTRAINT FK_35773F784584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE session_order_item_product ADD CONSTRAINT FK_35773F787E64D51E FOREIGN KEY (session_order_item_id) REFERENCES session_order_item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398D7707B45');
        $this->addSql('DROP INDEX UNIQ_F5299398613FECDF ON `order`');
        $this->addSql('DROP INDEX IDX_F5299398D7707B45 ON `order`');
        $this->addSql('ALTER TABLE `order` ADD slug VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP order_status_id');
        $this->addSql('ALTER TABLE order_item ADD slug VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('DROP INDEX UNIQ_B88F75C92B36786B ON order_status');
        $this->addSql('DROP INDEX UNIQ_B88F75C9989D9B62 ON order_status');
        $this->addSql('ALTER TABLE session_order_item DROP FOREIGN KEY FK_B27C14524584665A');
        $this->addSql('DROP INDEX IDX_B27C14524584665A ON session_order_item');
        $this->addSql('ALTER TABLE session_order_item DROP product_id');
    }
}
