<?php declare(strict_types=1);

namespace FaqPlugin;

use Shopware\Core\Framework\Plugin;
use Shopware\Core\Framework\Plugin\Context\ActivateContext;
use Shopware\Core\Framework\Plugin\Context\DeactivateContext;
use Shopware\Core\Framework\Plugin\Context\InstallContext;
use Shopware\Core\Framework\Plugin\Context\UninstallContext;
use Shopware\Core\Framework\Plugin\Context\UpdateContext;
use Shopware\Core\Framework\DataAbstractionLayer\Indexing\InheritanceUpdater;
use Doctrine\DBAL\Connection;


class FaqPlugin extends Plugin
{
    public function install(InstallContext $installContext): void
    {
    }

    public function uninstall(UninstallContext $uninstallContext): void
    {
        parent::uninstall($uninstallContext);

        if ($uninstallContext->keepUserData()) {
            return;
        }
        
        $connection = $this->container->get(Connection::class);

        $connection->executeStatement('DROP TABLE IF EXISTS `faq`');

        $connection->executeStatement('ALTER TABLE `product` DROP COLUMN `faqs`');
    }

    public function activate(ActivateContext $activateContext): void
    {
        // Activate entities, such as a new payment method
        // Or create new entities here, because now your plugin is installed and active for sure

      // run inheritance updater
      // $inheritanceUpdater = $this->container->get(InheritanceUpdater::class);
      // $inheritanceUpdater->update('faq', [], $activateContext->getContext());
    }

    public function deactivate(DeactivateContext $deactivateContext): void
    {
        // Deactivate entities, such as a new payment method
        // Or remove previously created entities
    }

    public function update(UpdateContext $updateContext): void
    {
        // Update necessary stuff, mostly non-database related
    }

    public function postInstall(InstallContext $installContext): void
    {
    }

    public function postUpdate(UpdateContext $updateContext): void
    {
    }
}
