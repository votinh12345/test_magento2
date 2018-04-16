<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Hiennv\Sales\Helper;

/**
 *
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    public $_storeManager;

    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->_storeManager=$storeManager;
    }

    /*
     * Get bg image email
     */
    public function getSrcImages($path) {
        $baseUrl = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        $src = $baseUrl . $path;
        return $src;
    }

    /*
     * Get link footer
     */
    public function getLinkFooterEmail() {
        $html = '';
        $html .= '<span><a href="#"><img src="'.$this->getSrcImages("email/twitter.png").'" alt="twitter" width="40px"> </a> </span>';
        $html .= '<span><a href="#"><img src="'.$this->getSrcImages("email/pinterest.png").'" alt="pinterest" width="40px"> </a> </span>';
        $html .= '<span><a href="#"><img src="'.$this->getSrcImages("email/instagram.png").'" alt="instagram" width="40px"> </a> </span>';
        return $html;
    }
}
