<?php
declare(strict_types=1);

namespace Meetanshi\Registration\Block\Index;

class Index extends \Magento\Framework\View\Element\Template
{
    protected $directoryBlock;
    protected $_isScopePrivate;
    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context  $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Directory\Block\Data $directoryBlock,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_isScopePrivate = true;
        $this->directoryBlock = $directoryBlock;
    }

    public function getCountries()
    {
        $country = $this->directoryBlock->getCountryHtmlSelect();
        return $country;
    }
    
    public function getRegion()
    {
        $region = $this->directoryBlock->getRegionHtmlSelect();
        return $region;
    }

    public function getCountryAction()
    {
        return $this->getUrl('meetanshi_registration/index/country', ['_secure' => true]);
    }

    public function getFormAction()
    {
        return $this->getUrl('meetanshi_registration/index/save', ['_secure' => true]);
    }
}

