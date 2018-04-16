<?php

namespace Hiennv\Sales\Observer;

use Magento\Framework\Event\ObserverInterface;

class ObserverforOrderSender implements ObserverInterface {

    protected $helperData;

    /**
     */
    public function __construct(\Hiennv\Sales\Helper\Data $dataHelper)
    {
        $this->helperData = $dataHelper;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        /** @var \Magento\Framework\App\Action\Action $controller */
        $transport = $observer->getTransport();
        $transport['bg_email'] = $this->helperData->getSrcImages('email/bg_mail.png');
        $transport['footer'] = $this->helperData->getLinkFooterEmail();
    }
}