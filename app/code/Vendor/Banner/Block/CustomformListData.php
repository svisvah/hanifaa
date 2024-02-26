<?php

namespace Vendor\Banner\Block;

use Magento\Framework\View\Element\Template\Context;
use Vendor\Banner\Model\BannerFactory;
/**
 * Customform List block
 */
class CustomformListData extends \Magento\Framework\View\Element\Template
{
    /**
     * @var Customform
     */
    protected $_customform;
    public function __construct(
        Context $context,
        BannerFactory $customform
    ) {
        $this->_customform = $customform;
        parent::__construct($context);
    }


    public function getCustomformCollection()
    {
        
        $customform = $this->_customform->create();
        $collection = $customform->getCollection();
        $collection->addFieldToFilter('status','1');
        //$customform->setOrder('id','ASC');
        

        return $collection;
    }

    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }
}