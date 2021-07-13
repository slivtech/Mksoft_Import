<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare( strict_types=1 );

namespace Mksoft\Import\Model;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Exception\LocalizedException;
use Mksoft\Import\Api\Data\MksoftProductInterface;
use Mksoft\Import\Api\MksoftProductRepositoryInterface;
use Mksoft\Import\Helper\Data;
use Magento\ConfigurableProduct\Model\Product\Type\Configurable;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Catalog\Model\ResourceModel\Product;
use Magento\Catalog\Api\Data\ProductInterface;

class MagentoAttribute {

    const PAGE_SIZE = 100;
    protected Data $helper;
    protected MksoftProductRepositoryInterface $mksoftProductRepository;
    protected ProductRepositoryInterface $productRepository;
    protected FilterBuilder $filterBuilder;
    protected SearchCriteriaBuilder $searchCriteriaBuilder;
    protected MksoftProductInterface $mksoftProduct;
    protected Product $productResource;
    protected ProductInterface $product;

    public function __construct(
        Data $helper,
        MksoftProductRepositoryInterface $mksoftProductRepository,
        ProductRepositoryInterface $productRepository,
        FilterBuilder $filterBuilder,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        Product $productResource
    ) {
        $this->helper                  = $helper;
        $this->mksoftProductRepository = $mksoftProductRepository;
        $this->productRepository       = $productRepository;
        $this->filterBuilder           = $filterBuilder;
        $this->searchCriteriaBuilder   = $searchCriteriaBuilder;
        $this->productResource         = $productResource;
    }

    /**
     * Update magento product attributes from mksoft product table
     * Skip updating attributes with flag not_update_price
     * @return int
     */
    public function updateProductAttributes() {
        $lastRun      = $this->helper->getLastRun();
        $updatedTotal = 0;
        $currentPage  = 1;

        $filter = $this->filterBuilder
            ->setField( MksoftProductInterface::UPDATED_AT )
            ->setConditionType( 'gt' )
            ->setValue( $lastRun )
            ->create();

        while ( true ) {
            $this->searchCriteriaBuilder->addFilters( [ $filter ] );
            $this->searchCriteriaBuilder->setPageSize( self::PAGE_SIZE );
            $this->searchCriteriaBuilder->setCurrentPage( $currentPage );
            $searchCriteria = $this->searchCriteriaBuilder->create();
            try {
                $mksoftProducts = $this->mksoftProductRepository->getList( $searchCriteria );
                if ( $mksoftProducts->getTotalCount() == 0 ) {
                    break;
                }
                foreach ( $mksoftProducts->getItems() as $mksoftProduct ) {
                    $this->mksoftProduct = $mksoftProduct;
                    foreach ( explode( ",", $this->mksoftProduct->getEntityIds() ) as $entityId ) {
                        $this->product = $this->productRepository->getById( $entityId );
                        if ( $this->product->getData( 'not_update_price' ) == "1" ) {
                            continue;
                        }
                        // Configurable product
                        if ( $this->product->getTypeId() == Configurable::TYPE_CODE ) {
                            $childs = $this->product->getTypeInstance()->getUsedProducts( $this->product );
                            /** @var \Magento\Catalog\Model\Product $child */
                            foreach ( $childs as $child ) {
                                $this->product = $child;
                                $this->saveAttribute();
                                $updatedTotal ++;
                            }
                        } // Simple product
                        else {
                            $this->saveAttribute();
                            $updatedTotal ++;
                        }
                    }
                }

                if ( $currentPage == ( ceil( $mksoftProducts->getTotalCount() / self::PAGE_SIZE ) ) ) {
                    break;
                }
            } catch ( LocalizedException $e ) {
            }

            $currentPage ++;
        }
        $this->helper->saveLastRun();

        return $updatedTotal;
    }

    public function saveAttribute() {
        $mksoftPrice  = floatval( $this->mksoftProduct->getPrice() );
        $productPrice = floatval( $this->product->getPrice() );
        //Update price if different only
        if ( abs( $productPrice - $mksoftPrice ) > 0.00001 ) {
            $this->product->setPrice( $mksoftPrice );
            $this->productResource->saveAttribute( $this->product, 'price' );

            //Update mksoft product old price with new magento price
            $this->mksoftProduct->setOldPrice( $mksoftPrice );
        }
        //Update EAN
        $this->product->setData( 'ean', $this->mksoftProduct->getEan() );
        $this->productResource->saveAttribute( $this->product, 'ean' );
        $this->mksoftProductRepository->save( $this->mksoftProduct );
    }
}
