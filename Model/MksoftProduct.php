<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Mksoft\Import\Model;

use Magento\Framework\Api\DataObjectHelper;
use Mksoft\Import\Api\Data\MksoftProductInterface;
use Mksoft\Import\Api\Data\MksoftProductInterfaceFactory;

class MksoftProduct extends \Magento\Framework\Model\AbstractModel
{

    protected $mksoftproductDataFactory;

    protected $dataObjectHelper;

    protected $_eventPrefix = 'mksoft_import_mksoftproduct';

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param MksoftProductInterfaceFactory $mksoftproductDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Mksoft\Import\Model\ResourceModel\MksoftProduct $resource
     * @param \Mksoft\Import\Model\ResourceModel\MksoftProduct\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        MksoftProductInterfaceFactory $mksoftproductDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Mksoft\Import\Model\ResourceModel\MksoftProduct $resource,
        \Mksoft\Import\Model\ResourceModel\MksoftProduct\Collection $resourceCollection,
        array $data = []
    ) {
        $this->mksoftproductDataFactory = $mksoftproductDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve mksoftproduct model with mksoftproduct data
     * @return MksoftProductInterface
     */
    public function getDataModel()
    {
        $mksoftproductData = $this->getData();
        
        $mksoftproductDataObject = $this->mksoftproductDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $mksoftproductDataObject,
            $mksoftproductData,
            MksoftProductInterface::class
        );
        
        return $mksoftproductDataObject;
    }
}

