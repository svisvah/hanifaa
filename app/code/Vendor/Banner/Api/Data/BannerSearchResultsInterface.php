<?php
declare(strict_types=1);

namespace Vendor\Banner\Api\Data;

interface BannerSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Customform list.
     * @return \Vendor\Banner\Api\Data\CustomformInterface[]
     */
    public function getItems();

    /**
     * Set id list.
     * @param \Vendor\Banner\Api\Data\CustomformInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

