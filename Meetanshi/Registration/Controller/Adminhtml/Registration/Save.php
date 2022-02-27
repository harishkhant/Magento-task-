<?php
namespace Meetanshi\Registration\Controller\Adminhtml\Registration;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Meetanshi\Registration\Model\RegistrationFactory;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Session\SessionManagerInterface;

class Save extends Action
{
    protected $_entityFactory;

    protected $resultPageFactory;

    protected $_sessionManager;

    public function __construct(
        Context $context,
        RegistrationFactory $entityFactory,
        PageFactory $resultPageFactory,
        \Magento\Ui\Component\MassAction\Filter $filter,
        SessionManagerInterface $sessionManager
    ){
        parent::__construct($context); 
        $this->_entityFactory = $entityFactory;
        $this->resultPageFactory = $resultPageFactory;
        $this->_sessionManager = $sessionManager;
        $this->filter = $filter;
     }

    public function execute() {

        $resultRedirect = $this->resultRedirectFactory->create();
        $entityModel = $this->_entityFactory->create();
        $data = $this->getRequest()->getPost();

        $myArray = json_decode(json_encode($data), true);

        $fulladdress =  $myArray["data"]["streetline1"]."  ".$myArray["data"]["streetline2"];
        $fullname =  $myArray["data"]["firstname"]." ".$myArray["data"]["lastname"];
        $entityModel->setData('title',$myArray["data"]["title"]);
        $entityModel->setData('firstname',$myArray["data"]["firstname"]);
        $entityModel->setData('lastname',$myArray["data"]["lastname"]);
        $entityModel->setData('name',$fullname);
        $entityModel->setData('email',$myArray["data"]["email"]);
        $entityModel->setData('dob',$myArray["data"]["dob"]);
        $entityModel->setData('streetline1',$myArray["data"]["streetline1"]);
        $entityModel->setData('streetline2',$myArray["data"]["streetline2"]);
        $entityModel->setData('address',$fulladdress); 
        $entityModel->setData('gender',$myArray["data"]["gender"]);
        $entityModel->setData('city',$myArray["data"]["city"]);
        if($myArray["data"]["region"]){
            $entityModel->setData('state',$myArray["data"]["region"]);
        }else{
            $entityModel->setData('state',$myArray["data"]["state"]);
        }
        $entityModel->setData('postcode',$myArray["data"]["postcode"]);
        $entityModel->setData('country',$myArray["data"]["country_id"]);
        $entityModel->setData('telephone',$myArray["data"]["telephone"]);

        $entityModel->save();
        //check for `back` parameter
        $this->_redirect('*/*');
        $this->messageManager->addSuccess(__('Data has been Saved Successfully.'));
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Meetanshi_Registration::meetanshi_save');
    }
}