<?php

namespace Vendor\Banner\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Store\Model\StoreManagerInterface;

class Thumbnail extends \Magento\Ui\Component\Listing\Columns\Column
{
    const NAME = 'banner_image';
    const ALT_FIELD = 'name';
    protected $storeManager;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param \Magento\Catalog\Helper\Image $imageHelper
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        StoreManagerInterface $storeManager,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->storeManager = $storeManager;
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');
            $path = $this->storeManager->getStore()->getBaseUrl(
                        \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
                    );
            foreach ($dataSource['data']['items'] as & $item) {
                if ($item['banner_image']) {
                    $item[$fieldName . '_src'] = $path.'banners/banner_images'.$item['banner_image'];
                    $item[$fieldName . '_alt'] = $item['alt_text'];
                    $item[$fieldName . '_orig_src'] = $path.'banners/banner_images'.$item['banner_image'];
                }else{
                    // please place your placeholder image at pub/media/magelearn/customform/placeholder/placeholder.jpg
                    $item[$fieldName . '_src'] = $path.'banners/banner_images/placeholder/placeholder.jpg';
                    $item[$fieldName . '_alt'] = 'Place Holder';
                    $item[$fieldName . '_orig_src'] = $path.'banners/banner_images/placeholder/placeholder.jpg';
                }
            }
        }

        return $dataSource;
    }
}
