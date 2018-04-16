<?php

namespace Hiennv\Upload\Model;

use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\StateException;
use Magento\Framework\Exception\ValidatorException;
use Magento\Framework\Exception\NoSuchEntityException;
use Hiennv\Upload\Api\ImageRepositoryInterface;
use Hiennv\Upload\Api\Data\ImageInterface;
use Hiennv\Upload\Api\Data\ImageInterfaceFactory;
use Hiennv\Upload\Model\ResourceModel\Images as ResourceImage;
use Hiennv\Upload\Model\ResourceModel\Images\CollectionFactory as ImageCollectionFactory;

class ImageRepository implements ImageRepositoryInterface
{
    /**
     * @var array
     */
    protected $instances = [];
    /**
     * @var ResourceImage
     */
    protected $resource;

    /**
     * @var ImageCollectionFactory
     */
    protected $imageCollectionFactory;

    /**
     * @var ImageInterfaceFactory
     */
    protected $imageInterfaceFactory;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    public function __construct(
        ResourceImage $resource,
        ImageCollectionFactory $imageCollectionFactory,
        ImageInterfaceFactory $imageInterfaceFactory,
        DataObjectHelper $dataObjectHelper
    ) {
        $this->resource = $resource;
        $this->imageCollectionFactory = $imageCollectionFactory;
        $this->imageInterfaceFactory = $imageInterfaceFactory;
        $this->dataObjectHelper = $dataObjectHelper;
    }

    /**
     * @param ImageInterface $image
     * @return ImageInterface
     * @throws CouldNotSaveException
     */
    public function save(ImageInterface $image)
    {
        try {
            /** @var ImageInterface|\Magento\Framework\Model\AbstractModel $image */
            $this->resource->save($image);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the image: %1',
                $exception->getMessage()
            ));
        }
        return $image;
    }

    /**
     * Get image record
     *
     * @param $imageId
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getById($imageId)
    {
        if (!isset($this->instances[$imageId])) {
            $image = $this->imageInterfaceFactory->create();
            $this->resource->load($image, $imageId);
            if (!$image->getId()) {
                throw new NoSuchEntityException(__('Requested image doesn\'t exist'));
            }
            $this->instances[$imageId] = $image;
        }
        return $this->instances[$imageId];
    }
}
