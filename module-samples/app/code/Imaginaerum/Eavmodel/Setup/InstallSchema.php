<?php

namespace Imaginaerum\Eavmodel\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface {

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context) {
        $setup->startSetup();
        /* Myeaventity */
        $entity = \Imaginaerum\Eavmodel\Model\Myeaventity::ENTITY;
        $table = $setup->getConnection()
                ->newTable($setup->getTable($entity . '_entity'))
                ->addColumn(
                        'entity_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true], 'Entity ID'
                )
                ->addColumn(
                        'code', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, ['nullable' => false], 'Creation Time'
                )
                ->addColumn(
                        'created_at', \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP, null, ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT], 'Creation Time'
                )
                ->addColumn(
                        'updated_at', \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP, null, ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE], 'Update Time'
                )
                ->setComment('Imaginaerum Eavmodel Myeaventity Table');
        $setup->getConnection()->createTable($table);
        /* eav structure */
        $eavs['decimal'] = ['type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL, 'length' => '12,4'];
        $eavs['varchar'] = ['type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 'length' => 255];
        $eavs['int'] = ['type' => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, 'length' => null];
        $eavs['text'] = ['type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 'length' => '64k'];
        $eavs['datetime'] = ['type' => \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME, 'length' => null];
        foreach ($eavs as $type => $data) {
            $table = $setup->getConnection()
                    ->newTable($setup->getTable($entity . '_entity_' . $type))
                    ->addColumn(
                            'value_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['identity' => true, 'nullable' => false, 'primary' => true], 'Value ID'
                    )
                    ->addColumn(
                            'attribute_id', \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT, null, ['unsigned' => true, 'nullable' => false, 'default' => '0'], 'Attribute ID'
                    )
                    ->addColumn(
                            'store_id', \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT, null, ['unsigned' => true, 'nullable' => false, 'default' => '0'], 'Store ID'
                    )
                    ->addColumn(
                            'entity_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['unsigned' => true, 'nullable' => false, 'default' => '0'], 'Entity ID'
                    )
                    ->addColumn(
                            'value', $data['type'], $data['length'], [], 'Value'
                    )
                    ->addIndex(
                            $setup->getIdxName(
                                    $entity . '_entity_' . $type, ['entity_id', 'attribute_id', 'store_id'], \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE
                            ), ['entity_id', 'attribute_id', 'store_id'], ['type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE]
                    )
                    ->addIndex(
                            $setup->getIdxName($entity . '_entity_' . $type, ['attribute_id']), ['attribute_id']
                    )
                    ->addIndex(
                            $setup->getIdxName($entity . '_entity_' . $type, ['store_id']), ['store_id']
                    )
                    ->addForeignKey(
                            $setup->getFkName(
                                    $entity . '_entity_' . $type, 'attribute_id', 'eav_attribute', 'attribute_id'
                            ), 'attribute_id', $setup->getTable('eav_attribute'), 'attribute_id', \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                    )
                    ->addForeignKey(
                            $setup->getFkName(
                                    $entity . '_entity_' . $type, 'entity_id', $entity . '_entity', 'entity_id'
                            ), 'entity_id', $setup->getTable($entity . '_entity'), 'entity_id', \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                    )
                    ->addForeignKey(
                            $setup->getFkName($entity . '_entity_' . $type, 'store_id', 'store', 'store_id'), 'store_id', $setup->getTable('store'), 'store_id', \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                    )
                    ->setComment(ucfirst($type) . ' Attribute Backend Table');
            $setup->getConnection()->createTable($table);
        }
        /* */
        $setup->endSetup();
    }

}
