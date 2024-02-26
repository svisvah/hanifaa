<?php
declare(strict_types=1);

namespace Vendor\Banner\Model\Customform;

use Vendor\Banner\Model\ResourceModel\Banner\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Filesystem;
use Magento\Framework\App\Filesystem\DirectoryList;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{

    protected $loadedData;
    protected $collection;
	protected $filesystem;
    protected $dataPersistor;
	/**
     * Store manager
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * Constructor
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        Filesystem $filesystem,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        $this->dataPersistor = $dataPersistor;
		$this->filesystem = $filesystem;
		$this->storeManager = $storeManager;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
   public function getData()
{
    if (isset($this->loadedData)) {
        return $this->loadedData;
    }
    
    $mediaDirectory = $this->filesystem->getDirectoryRead(DirectoryList::MEDIA);
    $destinationPath = $mediaDirectory->getAbsolutePath('banners/banner_images');
    
    $items = $this->collection->getItems();
    foreach ($items as $model) {
        $itemData = $model->getData();
        if ($model->getBannerImage()) { // Assuming the field is named 'banner_image'
            $imageName = $itemData['banner_image'];
            $itemData['banner_image'] = array(
                array(
                    'name'  => $imageName,
                    'url'   => $this->storeManager
                        ->getStore()
                        ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA)
                        . 'banners/banner_images/' . $imageName
                )
            );
        }
        $this->loadedData[$model->getId()] = $itemData;
    }
    
    $data = $this->dataPersistor->get('banners');
    
    if (!empty($data)) {
        $model = $this->collection->getNewEmptyItem();
        $model->setData($data);
        $this->loadedData[$model->getId()] = $model->getData();
        $this->dataPersistor->clear('banners');
    }
    
    return $this->loadedData;
}

}

