<?php

namespace Vendor\Banner\Model\ResourceModel;

class Banner extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('banners', 'banner_id');   //here "magelearn_customform" is table name and "id" is the primary key of custom table
    }
}

