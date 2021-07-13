<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare( strict_types=1 );

namespace Mksoft\Import\Cron;

use Mksoft\Import\Model\MagentoAttribute;
use Mksoft\Import\Logger\Logger;

class UpdateProductAttributes {

    protected Logger $logger;
    private MagentoAttribute $_magentoAttributeModel;

    /**
     * Constructor
     *
     * @param Logger $logger
     * @param MagentoAttribute $_magentoAttributeModel
     */
    public function __construct(
        Logger $logger,
        MagentoAttribute $_magentoAttributeModel
    ) {
        $this->logger       = $logger;
        $this->_magentoAttributeModel = $_magentoAttributeModel;
    }

    /**
     * Execute the cron
     *
     * @return void
     */
    public function execute() {
        $this->logger->info( "Cronjob Update magento product attributes is executed." );
        $updatedTotal = $this->_magentoAttributeModel->updateProductAttributes();
        $this->logger->info("Updated: {$updatedTotal} products.");
        $this->logger->info('-------------------------------------');
    }
}

