<?php declare(strict_types=1);

namespace FaqPlugin\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\InheritanceUpdaterTrait;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1707751145Faq extends MigrationStep
{
  use InheritanceUpdaterTrait;

  public function getCreationTimestamp(): int
  {
    return 1707751145;
  }

  public function update(Connection $connection): void
  {
    $this->createFaqTable($connection);

    $this->updateInheritance($connection, 'product', 'faqs');
  }

  public function updateDestructive(Connection $connection): void
  {
  }

  public function createFaqTable(Connection $connection): void
  {
    $connection->executeStatement('
      CREATE TABLE IF NOT EXISTS `faq` (
        `id` BINARY(16) NOT NULL,
        `active` TINYINT(1) NOT NULL DEFAULT 1,
        `question` LONGTEXT NOT NULL,
        `answer` LONGTEXT,
        `product_id` BINARY(16) NOT NULL,
        `created_at` DATETIME(3) NOT NULL,
        `updated_at` DATETIME(3),
        PRIMARY KEY (`id`),
        KEY `fk.faq.product_id` (`product_id`),
        CONSTRAINT `fk.faq.product_id` FOREIGN KEY (`product_id`)
          REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ');
  }
}
