<?php

namespace Hiennv\Upload\Model\ResourceModel;

class Images extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * construct
     * @return void
     */
    protected function _construct()
    {
        $this->_init('images', 'images_id');
    }
}
