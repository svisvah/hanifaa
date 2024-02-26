<?php
declare(strict_types=1);

namespace Vendor\Banner\Controller\Adminhtml\Banner;

class Index extends \Magento\Backend\App\Action
{

    protected $resultPageFactory;

    /**
     * Constructor
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * Index action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
		$resultPage->setActiveMenu('Vendor::top_level');
		$resultPage->addBreadcrumb(__('Banner'), __('Banner'));
        $resultPage->addBreadcrumb(__('Manage Banner'), __('Manage Banner'));
            $resultPage->getConfig()->getTitle()->prepend(__("Manage Banner"));
            return $resultPage;
    }
}

