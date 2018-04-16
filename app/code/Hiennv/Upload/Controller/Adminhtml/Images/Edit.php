<?php


namespace Hiennv\Upload\Controller\Adminhtml\Images;

class Edit extends \Hiennv\Upload\Controller\Adminhtml\Images
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('images_id');
        $storeViewId = $this->getRequest()->getParam('store');
        $model = $this->_imagesFactory->create();

        if ($id) {
            $model->setStoreViewId($storeViewId)->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This banner no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();

                return $resultRedirect->setPath('*/*/');
            }
        }

        $data = $this->_getSession()->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        $this->_coreRegistry->register('images', $model);

        $resultPage = $this->_resultPageFactory->create();

        return $resultPage;
    }
}
