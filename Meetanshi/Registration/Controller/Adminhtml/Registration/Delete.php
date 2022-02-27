<?php
namespace Meetanshi\Registration\Controller\Adminhtml\Registration;
 
use Magento\Backend\App\Action;
 
class Delete extends Action
{
    private $_model;

    public function __construct(
        Action\Context $context,
        \Meetanshi\Registration\Model\Registration $model
        ) {
            parent::__construct($context);
            $this->_model = $model;
          }  
 
        public function execute()
            {
                $id = $this->getRequest()->getParam('id');
                // echo $id;
                // die();
                $resultRedirect = $this->resultRedirectFactory->create();
                if ($id) {
                    try {
                        $model = $this->_model;
                        $model->load($id);
                        $model->delete();
                        $this->messageManager->addSuccess(__('User Successfully deleted'));
                        return $resultRedirect->setPath('myregistration/registration/index');
                    } catch (\Exception $e) {
                        $this->messageManager->addError($e->getMessage());
                        return $resultRedirect->setPath('myregistration/registration/edit', ['id' => $id]);
                    }
                }
                $this->messageManager->addError(__('Data does not exist'));
                return $resultRedirect->setPath('myregistration/registration/index');
            }
    
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Meetanshi_Registration::meetanshi_delete');
    }
}