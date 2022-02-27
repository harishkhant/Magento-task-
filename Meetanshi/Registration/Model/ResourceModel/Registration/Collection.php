<?php
namespace Meetanshi\Registration\Model\ResourceModel\Registration;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id';
    /**
     * Define resource model.
     */
    protected function _construct()
    {
        $this->_init('Meetanshi\Registration\Model\Registration', 'Meetanshi\Registration\Model\ResourceModel\Registration');
    }
}