<?php
declare(strict_types=1);

namespace Vendor\Banner\Model\Data;

use Vendor\Banner\Api\Data\BannerInterface;

class Banner extends \Magento\Framework\Api\AbstractExtensibleObject implements BannerInterface
{
    /**
     * Get id
     * @return string|null
     */
    public function getId()
    {
        return $this->_get(self::ID);
    }

    /**
     * Set id
     * @param string $id
     * @return \Vendor\Banner\Api\Data\CustomformInterface
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Vendor\Banner\Api\Data\CustomformExtensionInterface|null
     */
    

    /**
     * Get first_name
     * @return string|null
     */
    public function getAltText()
    {
        return $this->_get(self::ALT_TEXT);
    }

    /**
     * Set first_name
     * @param string $firstName
     * @return \Vendor\Banner\Api\Data\CustomformInterface
     */
    public function setAltText($altText)
    {
        return $this->setData(self::ALT_TEXT, $altText);
    }
	
	
    public function getStatus()
    {
        return $this->_get(self::STATUS);
    }

    /**
     * Set status
     * @param string $status
     * @return \Vendor\Banner\Api\Data\CustomformInterface
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }
	
    /**
     * Get image
     * @return string|null
     */
    public function getBannerImage()
    {
        return $this->_get(self::IMAGE);
    }

    /**
     * Set image
     * @param string $image
     * @return \Vendor\Banner\Api\Data\CustomformInterface
     */
    public function setBannerImage($image)
    {
        return $this->setData(self::IMAGE, $image);
    }

   
}

