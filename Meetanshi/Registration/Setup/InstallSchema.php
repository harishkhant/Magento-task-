<?php
namespace Meetanshi\Registration\Setup;
 
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Setup\Exception;
 
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     *
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
 
        $installer->startSetup();
        try {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('meetanshi_registration')
            )->addColumn(
                'id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'nullable' => false, 'primary' => true],
                'Record Id'
            )->addColumn(
                'title',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Title'
            )->addColumn(
                'firstname',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'FirstName'
            )->addColumn(
                'lastname',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'LastName'
            )->addColumn(
                'name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Name'
            )->addColumn(
                'email',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                '255',
                ['nullable' => false],
                'Email'
            )->addColumn(
                'gender',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Gender'
            )->addColumn(
                'dob',
                \Magento\Framework\DB\Ddl\Table::TYPE_DATE,
                null,
                [ 'nullable' => false],
                'Date of Birth'
            )->addColumn(
                'streetline1',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'streetline1'
            )->addColumn(
                'streetline2',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'streetline2'
            )->addColumn(
                'address',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Address'
            )->addColumn(
                'city',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'City'
            )->addColumn(
                'state',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'State'
            )->addColumn(
                'postcode',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Postcode'
            )->addColumn(
                'country',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Country'
            )->addColumn(
                'telephone',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                '255',
                ['nullable' => false],
                'Telephone'
            )->addColumn(
                'created_at',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                null,
                ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                'Created At'
            )->addColumn(
                'update_at',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                null,
                ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
                'Updated At'
            )->setComment(
                'Data Table'
            );
 
            $installer->getConnection()->createTable($table);
            $installer->endSetup();
        } catch (Exception $err) {
            \Magento\Framework\App\ObjectManager::getInstance()->get('Psr\Log\LoggerInterface')->info($err->getMessage());
        }
    }
}