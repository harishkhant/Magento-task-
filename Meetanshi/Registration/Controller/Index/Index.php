<?php
/**
 * Copyright © Create Extension Meetanshi_Registration All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Meetanshi\Registration\Controller\Index;

use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Framework\App\Action\Action
{

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * Constructor
     *
     * @param PageFactory $resultPageFactory
     */
     public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->_resultPageFactory = $resultPageFactory;
    }
    /**
     * Execute view action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        return $this->_resultPageFactory->create();
    }
}

