<?php


namespace Hiennv\Upload\Controller\Adminhtml\Images;

use Magento\Framework\App\Filesystem\DirectoryList;

class Save extends \Hiennv\Upload\Controller\Adminhtml\Images
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $model = $this->_imagesFactory->create();
            if (!empty($data['image'])) {
                if (isset($data['image'][0]['name'])) {
                    $fileName = $data['image'][0]['name'];
                } else {
                    $fileName = '';
                }
            } else {
                $fileName = '';
            }
            if (strlen($fileName)) {
                try {
                    $image = $this->getUploader('image')->uploadFileAndGetName('image', $data);
                    $data['image'] = $image;
                } catch (\Exception $e) {
                    if ($e->getCode() == 0) {
                        $this->messageManager->addError($e->getMessage());
                    }
                }
            } else {
                if (isset($data['image']) && isset($data['image']['value'])) {
                    if (isset($data['image']['delete'])) {
                        $data['image'] = null;
                        $data['delete_image'] = true;
                    } elseif (isset($data['image']['value'])) {
                        $data['image'] = $data['image']['value'];
                    } else {
                        $data['image'] = null;
                    }
                }
            }

            unset($data['images_id']);
            $model->setData($data);
            try {
                $model->save();
                $this->messageManager->addSuccess(__('The banner has been saved.'));
                $this->_getSession()->setFormData(false);
                return $this->_getBackResultRedirect($resultRedirect, $model->getId());
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                $this->messageManager->addException($e, __('Something went wrong while saving the banner.'));
            }
        }

        return $resultRedirect->setPath('*/*/');
    }

    /**
     * @param $type
     * @return Uploader
     * @throws \Exception
     */
    protected function getUploader($type)
    {
        return $this->uploaderPool->getUploader($type);
    }
}
