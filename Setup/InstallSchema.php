<?php
/**
 * Created by PhpStorm.
 * User: BOBLEE
 * Date: 30/01/2020
 * Time: 12:12 PM
 */

namespace Vaimo\UserAccountPostcodeManagement\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{

    const POST_CODE_TABLE_NAME = 'post_codes';

    const ACCOUNT_MANAGERS_TABLE_NAME = 'account_managers';

    const ACCOUNT_MANAGER_POST_CODES_TABLE_NAME = 'account_manager_post_codes';

    const ASSIGNED_CUSTOMER_MANAGER_TABLE_NAME = 'assigned_customer_manager';

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context) //@codingStandardsIgnoreLine
    {
        $setup->startSetup();

        /**
         * Create table 'post_codes'
         */
        $table = $setup->getConnection()->newTable(
            $setup->getTable(self::POST_CODE_TABLE_NAME)
        )->addColumn(
            'entity_id',
            Table::TYPE_INTEGER,
            5,
            ['identity' => true, 'nullable' => false, 'primary' => true],
            'Entity_Id'
        )->addColumn(
            'code',
            Table::TYPE_TEXT,
            10,
            ['nullable' => false],
            'post codes'
        )->setComment(
            'Post Codes Table'
        );


        $setup->getConnection()->createTable($table);


        // Account Manager Table Creation
        $table = $setup->getConnection()->newTable(
            $setup->getTable(self::ACCOUNT_MANAGERS_TABLE_NAME)
        )->addColumn(
            'entity_id',
            Table::TYPE_INTEGER,
            5,
            ['identity'=>true, 'nullable'=>false, 'primary'=>true],
            'primary key column'
        )->addColumn(
            'manager_name',
            Table::TYPE_TEXT,
            35,
            ['nullable'=>false],
            'Name of Account Manager'
        )->setComment(
            'Account Manager Table'
        );
        $setup->getConnection()->createTable($table);

        $table = $setup->getConnection()->newTable(
            $setup->getTable(self::ACCOUNT_MANAGER_POST_CODES_TABLE_NAME)
        )->addColumn(
            'entity_id',
            Table::TYPE_INTEGER,
            10,
            ['identity'=>true, 'nullable'=>false, 'primary'=>true],
            'primary key column'
        )->addColumn(
            'account_manager_id',
            Table::TYPE_INTEGER,
            5,
            ['nullable'=>false],
            'Id of account manager'
        )->addColumn(
            'post_code_id',
            Table::TYPE_INTEGER,
            5,
            ['nullable'=>false],
            'Id of post code'
        )->addIndex(
            $setup->getIdxName(
                $setup->getTable(self::ACCOUNT_MANAGER_POST_CODES_TABLE_NAME),
                ['post_code_id'],
                AdapterInterface::INDEX_TYPE_UNIQUE
            ),
            ['post_code_id'],
            ['type'=>AdapterInterface::INDEX_TYPE_UNIQUE]
        )->addIndex(
            $setup->getIdxName(
                $setup->getTable(self::ACCOUNT_MANAGER_POST_CODES_TABLE_NAME),
                ['account_manager_id'],
                AdapterInterface::INDEX_TYPE_INDEX
            ),
            ['account_manager_id'],
            ['type'=>AdapterInterface::INDEX_TYPE_INDEX]
        )->addForeignKey(
            $setup->getFkName(
                $setup->getTable(self::ACCOUNT_MANAGER_POST_CODES_TABLE_NAME),
                'post_code_id',
                self::POST_CODE_TABLE_NAME,
                'entity_id'
            ),
            'post_code_id',
            self::POST_CODE_TABLE_NAME,
            'entity_id',
            Table::ACTION_CASCADE
        )->addForeignKey(
            $setup->getFkName(
                $setup->getTable(self::ACCOUNT_MANAGER_POST_CODES_TABLE_NAME),
                'account_manager_id',
                self::ACCOUNT_MANAGERS_TABLE_NAME,
                'entity_id'
            ),
            'account_manager_id',
            self::ACCOUNT_MANAGERS_TABLE_NAME,
            'entity_id',
            Table::ACTION_CASCADE
        )->setComment(
            'Account Manager post codes Table'
        );
        $setup->getConnection()->createTable($table);


        $table = $setup->getConnection()->newTable(
            $setup->getTable(self::ASSIGNED_CUSTOMER_MANAGER_TABLE_NAME)
        )->addColumn(
            'entity_id',
            Table::TYPE_INTEGER,
            10,
            ['identity'=>true, 'nullable'=>false, 'primary'=>true],
            'primary key column'
        )->addColumn(
            'quote_id',
            Table::TYPE_INTEGER,
            10,
            ['nullable'=>false, 'unsigned'=>true],
            'Quote Id of order'
        )->addColumn(
            'manager_id',
            Table::TYPE_INTEGER,
            5,
            ['nullable'=>false],
            'Id of Manager'
        )->addIndex(
            $setup->getIdxName(
                $setup->getTable(self::ASSIGNED_CUSTOMER_MANAGER_TABLE_NAME),
                ['quote_id'],
                AdapterInterface::INDEX_TYPE_UNIQUE
            ),
            ['quote_id'],
            ['type'=>AdapterInterface::INDEX_TYPE_UNIQUE]
        )->addIndex(
            $setup->getIdxName(
                $setup->getTable(self::ASSIGNED_CUSTOMER_MANAGER_TABLE_NAME),
                ['manager_id'],
                AdapterInterface::INDEX_TYPE_INDEX
            ),
            ['manager_id'],
            ['type'=>AdapterInterface::INDEX_TYPE_INDEX]
        )->addForeignKey(
            $setup->getFkName(
                $setup->getTable(self::ASSIGNED_CUSTOMER_MANAGER_TABLE_NAME),
                'quote_id',
                'quote',
                'entity_id'
            ),
            'quote_id',
            'quote',
            'entity_id',
            Table::ACTION_CASCADE
        )->addForeignKey(
            $setup->getFkName(
                $setup->getTable(self::ACCOUNT_MANAGER_POST_CODES_TABLE_NAME),
                'manager_id',
                self::ACCOUNT_MANAGERS_TABLE_NAME,
                'entity_id'
            ),
            'manager_id',
            self::ACCOUNT_MANAGERS_TABLE_NAME,
            'entity_id',
            Table::ACTION_CASCADE
        )->setComment(
            'Customers orders assigned to managers'
        );
        $setup->getConnection()->createTable($table);
        $setup->endSetup();
    }
}