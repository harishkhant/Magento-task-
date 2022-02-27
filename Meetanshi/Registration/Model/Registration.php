<?php
namespace Meetanshi\Registration\Model;

use Magento\Framework\Model\AbstractModel;

class Registration extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Meetanshi\Registration\Model\ResourceModel\Registration::class);
    }
    
}
