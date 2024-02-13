<?php declare(strict_types=1);

namespace FaqPlugin\Core\Content\Faq\Product;

use Shopware\Core\Framework\DataAbstractionLayer\EntityExtension;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\Content\Product\ProductDefinition;
use FaqPlugin\Core\Content\Faq\FaqDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Inherited;

class FaqProductExtension extends EntityExtension
{
    public function extendFields(FieldCollection $collection): void
    {
        $collection->add(
            (new OneToManyAssociationField('faqs', 'faqs', FaqDefinition::class, 'id', true))->addFlags(new Inherited())
        );
    }

    public function getDefinitionClass(): string
    {
        return ProductDefinition::class;
    }
}