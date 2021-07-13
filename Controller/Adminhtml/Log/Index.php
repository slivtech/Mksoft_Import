<?php

namespace Mksoft\Import\Controller\Adminhtml\Log;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 */
class Index extends Action implements HttpGetActionInterface {
    const MENU_ID = 'Mksoft_Import::mksoft_import_log';

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * Index constructor.
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct( $context );

        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Load the page defined in view/adminhtml/layout/mksoft_import_log_index.xml
     *
     * @return Page
     */
    public function execute() {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu( self::MENU_ID );
        $resultPage->getConfig()->getTitle()->prepend( __( 'Logs' ) );

        return $resultPage;
    }
}
