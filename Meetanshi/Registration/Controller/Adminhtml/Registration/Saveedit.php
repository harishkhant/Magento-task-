<?php
namespace Meetanshi\Registration\Controller\Adminhtml\Registration;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Meetanshi\Registration\Model\RegistrationFactory;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Session\SessionManagerInterface;

class Saveedit extends Action
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
    $products = $this->getRequest()->getPost('id');
    $myArray = json_decode(json_encode($data), true);
    
    $final_pid=$products.'&';
    
    $entityModel->setData('id',$myArray["rowdata"]["id"]);
    $fulladdress =  $myArray["rowdata"]["streetline1"]."  ".$myArray["rowdata"]["streetline2"];
    $fullname =  $myArray["rowdata"]["firstname"]." ".$myArray["rowdata"]["lastname"];
    $entityModel->setData('title',$myArray["rowdata"]["title"]);
    $entityModel->setData('firstname',$myArray["rowdata"]["firstname"]);
    $entityModel->setData('lastname',$myArray["rowdata"]["lastname"]);
    $entityModel->setData('name',$fullname);
    $entityModel->setData('email',$myArray["rowdata"]["email"]);
    $entityModel->setData('dob',$myArray["rowdata"]["dob"]);
    $entityModel->setData('streetline1',$myArray["rowdata"]["streetline1"]);
    $entityModel->setData('streetline2',$myArray["rowdata"]["streetline2"]);
    $entityModel->setData('address',$fulladdress); 
    $entityModel->setData('gender',$myArray["rowdata"]["gender"]);
    $entityModel->setData('city',$myArray["rowdata"]["city"]);
    if($myArray["rowdata"]["region"]){
        $entityModel->setData('state',$myArray["rowdata"]["region"]);
    }else{
        $entityModel->setData('state',$myArray["rowdata"]["state"]);
    }
    $entityModel->setData('postcode',$myArray["rowdata"]["postcode"]);
    $entityModel->setData('country',$myArray["rowdata"]["country_id"]);
    $entityModel->setData('telephone',$myArray["rowdata"]["telephone"]);
    $modifiedDate = date("y-m-d h:i:s");
    $entityModel->setData('update_at',$modifiedDate);
    $entityModel->save();
    //check for `back` parameter
    $this->_redirect('*/*');
    $this->messageManager->addSuccess(__('Data has been Edited.'));
  }

  protected function _isAllowed()
  {
      return $this->_authorization->isAllowed('Meetanshi_Registration::meetanshi_saveedit');
  }
}