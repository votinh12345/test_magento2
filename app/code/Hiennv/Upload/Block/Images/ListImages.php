<?php

namespace Hiennv\Upload\Block\Images;

class ListImages extends \Magento\Framework\View\Element\Template
{
    const IMAGE_PATH        = 'Hiennv/images/image';

    protected $_imagesCollectionFactory;

    /**
     * Store manager.
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Hiennv\Upload\Model\ResourceModel\Images\Collection $imagesCollectionFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_imagesCollectionFactory = $imagesCollectionFactory;
        $this->_storeManager = $storeManager;
    }


    /**
     * get image collection
     *
     */
    public function getImagesCollection()
    {
        return $this->_imagesCollectionFactory->getImageCollection();
    }

    /**
     * get banner image url.
     *
     *
     * @return string
     */
    public function getBannerImageUrl(\Hiennv\Upload\Model\Images $images, $secure = false)
    {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA, $secure) . self::IMAGE_PATH. $images->getImage();
    }
}