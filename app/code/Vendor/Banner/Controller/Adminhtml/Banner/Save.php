<?php
declare(strict_types=1);

namespace Vendor\Banner\Controller\Adminhtml\Banner;

use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{

    protected $dataPersistor;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
    ) {
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('id');
        	
            $model = $this->_objectManager->create(\Vendor\Banner\Model\Banner::class)->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Customform no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }
        	
			if (isset($data['banner_image'][0]['name']) && isset($data['banner_image'][0]['tmp_name'])) {
                $data['banner_image'] =$data['banner_image'][0]['name'];
                $imageUploader = \Magento\Framework\App\ObjectManager::getInstance()->get(
                'Vendor\Banner\CustomformImageUpload'
            );
                $imageUploader->moveFileFromTmp($data['banner_image']);
            } elseif (isset($data['banner_image'][0]['name']) && !isset($data['banner_image'][0]['tmp_name'])) {
                $data['banner_image'] = $data['banner_image'][0]['name'];
            } else {
                $data['banner_image'] = null;
            }
            $model->setData($data);
        
            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the Banner.'));
                $this->dataPersistor->clear('banners');
        
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['banner_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Customform.'));
            }
        
            $this->dataPersistor->set('banners', $data);
            return $resultRedirect->setPath('*/*/edit', ['banner_id' => $this->getRequest()->getParam('banner_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}

