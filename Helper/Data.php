<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare( strict_types=1 );

namespace Mksoft\Import\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Config\ReinitableConfigInterface;

class Data extends AbstractHelper {
    const MKSOFT_LAST_RUN = 'mksoft/run/last_date';
    protected WriterInterface $_configWriter;
    protected ScopeConfigInterface $_scopeConfig;
    protected ReinitableConfigInterface $_reinitableConfig;

    /**
     * @param \Magento\Framework\App\Config\Storage\WriterInterface $_configWriter
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $_scopeConfig
     * @param \Magento\Framework\App\Config\ReinitableConfigInterface $_reinitableConfig
     * @param \Magento\Framework\App\Helper\Context $context
     */
    public function __construct(
        WriterInterface $_configWriter,
        ScopeConfigInterface $_scopeConfig,
        ReinitableConfigInterface $_reinitableConfig,
        \Magento\Framework\App\Helper\Context $context
    ) {
        $this->_configWriter     = $_configWriter;
        $this->_scopeConfig      = $_scopeConfig;
        $this->_reinitableConfig = $_reinitableConfig;
        parent::__construct( $context );
    }

    /**
     * Get last script execution datetime
     * @return string
     */
    public function getLastRun() {
        $this->_reinitableConfig->reinit();
        $lastUpdate = $this->_scopeConfig->getValue( self::MKSOFT_LAST_RUN );
        if ( ! $lastUpdate ) {
            $lastUpdate = date( 'Y-m-d H:i:s' );
        }

        return $lastUpdate;
    }

    /**
     * Save last script execution datetime
     */
    public function saveLastRun() {
        $this->_configWriter->save( self::MKSOFT_LAST_RUN, date( 'Y-m-d H:i:s' ) );
    }
}
