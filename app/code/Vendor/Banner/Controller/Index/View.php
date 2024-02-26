<?php

namespace Vendor\Banner\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Exception\NotFoundException;
use Vendor\Banner\Block\CustomformListData;

class View extends \Magento\Framework\App\Action\Action
{
	protected $_customformview;

	public function __construct(
        Context $context,
        CustomformListData $customformview
    ) {
        $this->_customformview = $customformview;
        parent::__construct($context);
    }

	public function execute()
    {
    	if(!$this->_customformview->getSingleData()){
    		throw new NotFoundException(__('Parameter is incorrect.'));
    	}
    	
        $this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->renderLayout();
    }
}
