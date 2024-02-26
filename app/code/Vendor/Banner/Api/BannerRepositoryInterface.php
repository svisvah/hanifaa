<?php
declare(strict_types=1);

namespace Vendor\Banner\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface BannerRepositoryInterface
{

    /**
     * Save Banner
     * @param \Vendor\Banner\Api\Data\BannerInterface $Banner
     * @return \Vendor\Banner\Api\Data\BannerInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Vendor\Banner\Api\Data\BannerInterface $customform
    );

    /**
     * Retrieve Customform
     * @param string $customformId
     * @return \Vendor\Banner\Api\Data\CustomformInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($customformId);

    /**
     * Retrieve Customform matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Vendor\Banner\Api\Data\CustomformSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Customform
     * @param \Vendor\Banner\Api\Data\CustomformInterface $customform
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Vendor\Banner\Api\Data\BannerInterface $customform
    );

    /**
     * Delete Customform by ID
     * @param string $customformId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($customformId);
}

