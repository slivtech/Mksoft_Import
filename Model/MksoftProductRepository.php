<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare( strict_types=1 );

namespace Mksoft\Import\Model;

use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Mksoft\Import\Api\Data\MksoftProductInterfaceFactory;
use Mksoft\Import\Api\Data\MksoftProductSearchResultsInterfaceFactory;
use Mksoft\Import\Api\MksoftProductRepositoryInterface;
use Mksoft\Import\Model\ResourceModel\MksoftProduct as ResourceMksoftProduct;
use Mksoft\Import\Model\ResourceModel\MksoftProduct\CollectionFactory as MksoftProductCollectionFactory;

class MksoftProductRepository implements MksoftProductRepositoryInterface {
    protected $dataMksoftProductFactory;
    protected $resource;
    protected $extensibleDataObjectConverter;
    protected $searchResultsFactory;
    protected $mksoftProductFactory;
    protected $mksoftProductCollectionFactory;
    protected $dataObjectHelper;
    protected $dataObjectProcessor;
    protected $extensionAttributesJoinProcessor;
    private $collectionProcessor;

    /**
     * @param ResourceMksoftProduct $resource
     * @param MksoftProductFactory $mksoftProductFactory
     * @param MksoftProductInterfaceFactory $dataMksoftProductFactory
     * @param MksoftProductCollectionFactory $mksoftProductCollectionFactory
     * @param MksoftProductSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceMksoftProduct $resource,
        MksoftProductFactory $mksoftProductFactory,
        MksoftProductInterfaceFactory $dataMksoftProductFactory,
        MksoftProductCollectionFactory $mksoftProductCollectionFactory,
        MksoftProductSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource                         = $resource;
        $this->mksoftProductFactory             = $mksoftProductFactory;
        $this->mksoftProductCollectionFactory   = $mksoftProductCollectionFactory;
        $this->searchResultsFactory             = $searchResultsFactory;
        $this->dataObjectHelper                 = $dataObjectHelper;
        $this->dataMksoftProductFactory         = $dataMksoftProductFactory;
        $this->dataObjectProcessor              = $dataObjectProcessor;
        $this->collectionProcessor              = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter    = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Mksoft\Import\Api\Data\MksoftProductInterface $mksoftProduct
    ) {
        $mksoftProductData = $this->extensibleDataObjectConverter->toNestedArray(
            $mksoftProduct,
            [],
            \Mksoft\Import\Api\Data\MksoftProductInterface::class
        );

        $mksoftProductModel = $this->mksoftProductFactory->create()->setData( $mksoftProductData );

        try {
            $this->resource->save( $mksoftProductModel );
        } catch ( \Exception $exception ) {
            throw new CouldNotSaveException( __(
                'Could not save the mksoftProduct: %1',
                $exception->getMessage()
            ) );
        }

        return $mksoftProductModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->mksoftProductCollectionFactory->create();

        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Mksoft\Import\Api\Data\MksoftProductInterface::class
        );

        $this->collectionProcessor->process( $criteria, $collection );

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria( $criteria );

        $items = [];
        foreach ( $collection as $model ) {
            $items[] = $model->getDataModel();
        }

        $searchResults->setItems( $items );
        $searchResults->setTotalCount( $collection->getSize() );

        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById( $mksoftProductId ) {
        return $this->delete( $this->get( $mksoftProductId ) );
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Mksoft\Import\Api\Data\MksoftProductInterface $mksoftProduct
    ) {
        try {
            $mksoftProductModel = $this->mksoftProductFactory->create();
            $this->resource->load( $mksoftProductModel, $mksoftProduct->getMksoftproductId() );
            $this->resource->delete( $mksoftProductModel );
        } catch ( \Exception $exception ) {
            throw new CouldNotDeleteException( __(
                'Could not delete the MksoftProduct: %1',
                $exception->getMessage()
            ) );
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function get( $mksoftProductId ) {
        $mksoftProduct = $this->mksoftProductFactory->create();
        $this->resource->load( $mksoftProduct, $mksoftProductId );
        if ( ! $mksoftProduct->getId() ) {
            throw new NoSuchEntityException( __( 'MksoftProduct with id "%1" does not exist.', $mksoftProductId ) );
        }

        return $mksoftProduct->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getByPlu( $plu ) {
        $mksoftProduct = $this->mksoftProductFactory->create();
        $this->resource->load( $mksoftProduct, $plu, 'plu' );
        if ( ! $mksoftProduct->getId() ) {
            throw new NoSuchEntityException( __( 'MksoftProduct with PLU "%1" does not exist.', $plu ) );
        }

        return $mksoftProduct->getDataModel();
    }
}
