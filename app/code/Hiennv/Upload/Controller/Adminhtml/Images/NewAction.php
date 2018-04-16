<?php


namespace Hiennv\Upload\Controller\Adminhtml\Images;


class NewAction extends \Hiennv\Upload\Controller\Adminhtml\Images
{
    public function execute()
    {
        $resultForward = $this->_resultForwardFactory->create();

        return $resultForward->forward('edit');
    }
}
