<?php
declare(strict_types=1);

namespace Vendor\Banner\Api\Data;

interface BannerInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{
	const ID = 'banner_id';
    const IMAGE = 'banner_image';
    const ALT_TEXT = 'alt_text';
	const STATUS = 'status';

    /**
     * Get id
     * @return string|null
     */
    public function getId();

    /**
     * Set id
     * @param string $id
     * @return \Vendor\Banner\Api\Data\CustomformInterface
     */
    public function setId($id);

    public function getAltText();

    /**
     * Set first_name
     * @param string $firstName
     * @return \Vendor\Banner\Api\Data\CustomformInterface
     */
    public function setAltText($altText);
	

    /**
     * Get image
     * @return string|null
     */
    public function getBannerImage();

    /**
     * Set image
     * @param string $image
     * @return \Vendor\Banner\Api\Data\CustomformInterface
     */
    public function setBannerImage($image);
	
	/**
     * Get status
     * @return string|null
     */
    public function getStatus();

    /**
     * Set status
     * @param string $status
     * @return \Vendor\Banner\Api\Data\CustomformInterface
     */
    public function setStatus($status);


    
	
}

