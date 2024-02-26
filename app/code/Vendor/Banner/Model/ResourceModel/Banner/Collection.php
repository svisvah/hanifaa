<?php
declare(strict_types=1);

namespace Vendor\Banner\Model\ResourceModel\Banner;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'banner_id';
	protected $_previewFlag;
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Vendor\Banner\Model\Banner::class,
            \Vendor\Banner\Model\ResourceModel\Banner::class
        );
		$this->_map['fields']['id'] = 'main_table.id';
    }
}

