<?php


namespace Hiennv\Upload\Model\ResourceModel\Images\Grid;

/**
 * Class TargetArray
 */
class TargetArray implements \Magento\Framework\Option\ArrayInterface
{
    const BANNER_TARGET_SELF = 1;
    const BANNER_TARGET_PARENT = 2;

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $options = [];
        $options[] = [
            'label' => __('New Window with Browser Navigation'),
            'value' => self::BANNER_TARGET_SELF
        ];
        $options[] = [
            'label' => __('Parent Window with Browser Navigation'),
            'value' => self::BANNER_TARGET_PARENT
        ];
        return $options;
    }
}
