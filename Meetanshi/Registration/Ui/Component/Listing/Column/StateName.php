<?php
namespace Meetanshi\Registration\Ui\Component\Listing\Column;
 
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;
 
class StateName extends Column
{ 
    protected $urlBuilder;
 
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }
  
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {  
           
            foreach ($dataSource['data']['items'] as & $item) {
        
            $stateIds = $item["state"];

            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $_regionFactory = $objectManager->get('Magento\Directory\Model\RegionFactory');
            $regionModel = $_regionFactory->create();

            if (is_numeric($stateIds)) {
                $shipperRegion = $_regionFactory->create()->load($stateIds );
                $shipperRegionName = $shipperRegion->getName();
                $stateIds = $item["state"] = $shipperRegionName; 
              }
            }
        }
        return $dataSource;
    }
}