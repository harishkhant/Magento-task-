<?php
namespace Meetanshi\Registration\Model\DataSource;

use Meetanshi\Registration\Model\ResourceModel\Registration\CollectionFactory;
use Meetanshi\Registration\Model\Registration;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $contactCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $contactCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        $this->loadedData = array();
        
        foreach ($items as $rowdata) {
           
            $this->loadedData[$rowdata->getId()]['rowdata'] = $rowdata->getData();
            
        }
        return $this->loadedData;
    }
}