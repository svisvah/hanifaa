<?php
declare(strict_types=1);

namespace Vendor\Banner\Model;

use Vendor\Banner\Api\Data\BannerInterface;
use Vendor\Banner\Api\Data\BannerInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;

class Banner extends \Magento\Framework\Model\AbstractModel
{

    protected $_eventPrefix = 'banners';
    protected $dataObjectHelper;

    protected $customformDataFactory;

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param CustomformInterfaceFactory $customformDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Vendor\Banner\Model\ResourceModel\Banner $resource
     * @param \Vendor\Banner\Model\ResourceModel\Banner\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        BannerInterfaceFactory $customformDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Vendor\Banner\Model\ResourceModel\Banner $resource,
        \Vendor\Banner\Model\ResourceModel\Banner\Collection $resourceCollection,
        array $data = []
    ) {
        $this->customformDataFactory = $customformDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve customform model with customform data
     * @return CustomformInterface
     */
    public function getDataModel()
    {
        $customformData = $this->getData();
        
        $customformDataObject = $this->customformDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $customformDataObject,
            $customformData,
            BannerInterface::class
        );
        
        return $customformDataObject;
    }
}

