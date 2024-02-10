<?php declare(strict_types=1);

namespace FaqPlugin\Core\Content\Faq;

use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\Framework\DataAbstractionLayer\Field\BoolField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\LongTextField;
use Shopware\Core\Content\Product\ProductDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToOneAssociationField;

class FaqDefinition extends EntityDefinition
{
    public const ENTITY_NAME = 'faq';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getEntityClass(): string
    {
        return FaqEntity::class;
    }

    public function getCollectionClass(): string
    {
        return FaqCollection::class;
    }

    protected function defineFields(): FieldCollection
    {
        /*
         * IdField id
         * BoolField active
         * StringField question
         * StringField answer
         * FkField product_id
         * ManyToOneAssociation product
         * 
         * required: id, active, question, product_id
         */
        return new FieldCollection([
            (new IdField('id', 'id'))->addFlags(new Required(), new PrimaryKey()),
            (new BoolField('active', 'active'))->addFlags(new Required()),
            (new LongTextField('question', 'question'))->addFlags(new Required()),
            (new LongTextField('answer', 'answer')),
            (new FkField('product_id', 'productId', ProductDefinition::class)),
            (new ManyToOneAssociationField('product', 'product_id', ProductDefinition::class)),
        ]);
    }
}
