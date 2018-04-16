<?php

namespace Hiennv\Upload\Model\ResourceModel\Images;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    const STATUS_ENABLED = 1;

    protected $_idFieldName = 'images_id';

    /**
     *
     */
    protected function _construct()
    {
        $this->_init('Hiennv\Upload\Model\Images', 'Hiennv\Upload\Model\ResourceModel\Images');
    }

    /**
     * @return $this
     */
    public function getImageCollection()
    {
        $imagesCollection = $this->addFieldToFilter('status', self::STATUS_ENABLED)
            ->setOrder('images_id', 'ASC');
        return $imagesCollection;
    }
}
