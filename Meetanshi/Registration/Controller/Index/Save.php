<?php
/**
 * Copyright © Create Extension Meetanshi_Registration All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Meetanshi\Registration\Controller\Index;

use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;
use Meetanshi\Registration\Model\RegistrationFactory;

class Save extends \Magento\Framework\App\Action\Action
{

    protected $_entityFactory;

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
        RegistrationFactory $entityFactory,
        \Magento\Framework\App\Request\Http $request,
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Controller\Result\RedirectFactory $resultRedirectFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Message\ManagerInterface $messageManager
    ) {
        parent::__construct($context);
        $this->_entityFactory = $entityFactory;
        $this->_request = $request;
        $this->_resultPageFactory = $resultPageFactory;
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->_messageManager = $messageManager;
    }
    /**
     * Execute view action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $data = (array) $this->getRequest()->getPost();
        $entityModel = $this->_entityFactory->create();
        $myArray = json_decode(json_encode($data), true);

       $dob = $myArray["datepicker"];
        $fulladdress =  $myArray['street'][0]."  ".$myArray['street'][1];
        $fullname =  $myArray["firstname"]." ".$myArray["lastname"];
        $entityModel->setData('title',$myArray["prefix"]);
        $entityModel->setData('firstname',$myArray["firstname"]);
        $entityModel->setData('lastname',$myArray["lastname"]);
        $entityModel->setData('name',$fullname);
        $entityModel->setData('email',$myArray["email"]);
        $entityModel->setData('dob',$dob);
        $entityModel->setData('streetline1',$myArray['street'][0]);
        $entityModel->setData('streetline2',$myArray['street'][1]);
        $entityModel->setData('address',$fulladdress); 
        $entityModel->setData('gender',$myArray["gender"]);
        $entityModel->setData('city',$myArray["city"]);
        if($myArray["state"]){
            $entityModel->setData('state',$myArray["state"]);
        }else{
            $entityModel->setData('state',$myArray["region"]);
        }
        
        $entityModel->setData('postcode',$myArray["postcode"]);
        $entityModel->setData('country',$myArray["country_id"]);
        $entityModel->setData('telephone',$myArray["telephone"]);

        if($entityModel->save()){
            $this->_messageManager->addSuccess(__('Data has been Saved Successfully.'));
            $resultRedirect = $this->resultRedirectFactory->create();
            $resultRedirect->setRefererOrBaseUrl();
            return $resultRedirect;
        }else{
            $this->_messageManager->addError(__("Data can't be Saved right now. Please try again later."));
            $resultRedirect = $this->resultRedirectFactory->create();
            $resultRedirect->setRefererOrBaseUrl();
            return $resultRedirect;
        }
    }
}

