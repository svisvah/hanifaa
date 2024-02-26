<?php
declare(strict_types=1);

namespace Vendor\Banner\Model;

use Vendor\Banner\Api\BannerRepositoryInterface;
use Vendor\Banner\Api\Data\BannerInterfaceFactory;
use Vendor\Banner\Api\Data\BannerSearchResultsInterfaceFactory;
use Vendor\Banner\Model\ResourceModel\Banner as ResourceBanner;
use Vendor\Banner\Model\ResourceModel\Banner\CollectionFactory as BannerCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;

class BannerRepository implements BannerRepositoryInterface
{

    private $collectionProcessor;

    protected $dataObjectHelper;

    protected $extensionAttributesJoinProcessor;

    protected $customformCollectionFactory;

    protected $customformFactory;

    protected $searchResultsFactory;

    protected $dataObjectProcessor;

    protected $extensibleDataObjectConverter;
    protected $resource;

    protected $dataCustomformFactory;

    private $storeManager;


    /**
     * @param ResourceBanner $resource
     * @param BannerFactory $customformFactory
     * @param BannerInterfaceFactory $dataCustomformFactory
     * @param BannerCollectionFactory $customformCollectionFactory
     * @param BannerSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceBanner $resource,
        BannerFactory $customformFactory,
        BannerInterfaceFactory $dataCustomformFactory,
        BannerCollectionFactory $customformCollectionFactory,
        BannerSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->customformFactory = $customformFactory;
        $this->customformCollectionFactory = $customformCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataCustomformFactory = $dataCustomformFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Vendor\Banner\Api\Data\BannerInterface $customform
    ) {
        /* if (empty($customform->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $customform->setStoreId($storeId);
        } */
        
        $customformData = $this->extensibleDataObjectConverter->toNestedArray(
            $customform,
            [],
            \Vendor\Banner\Api\Data\BannerInterface::class
        );
        
        $customformModel = $this->customformFactory->create()->setData($customformData);
        
        try {
            $this->resource->save($customformModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the customform: %1',
                $exception->getMessage()
            ));
        }
        return $customformModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($customformId)
    {
        $customform = $this->customformFactory->create();
        $this->resource->load($customform, $customformId);
        if (!$customform->getId()) {
            throw new NoSuchEntityException(__('Customform with id "%1" does not exist.', $customformId));
        }
        return $customform->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->customformCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Vendor\Banner\Api\Data\BannerInterface::class
        );
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Vendor\Banner\Api\Data\BannerInterface $customform
    ) {
        try {
            $customformModel = $this->customformFactory->create();
            $this->resource->load($customformModel, $customform->getCustomformId());
            $this->resource->delete($customformModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Customform: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($customformId)
    {
        return $this->delete($this->get($customformId));
    }
}

