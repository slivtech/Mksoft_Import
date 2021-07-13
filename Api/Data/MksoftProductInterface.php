<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Mksoft\Import\Api\Data;

interface MksoftProductInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const PLU = 'plu';
    const TITLE = 'title';
    const MKSOFTPRODUCT_ID = 'mksoftproduct_id';
    const PRICE = 'price';
    const EAN = 'ean';
    const ENTITY_IDS = 'entity_ids';
    const OLD_PRICE = 'old_price';
    const UPDATED_AT = 'updated_at';

    /**
     * Get mksoftproduct_id
     * @return string|null
     */
    public function getMksoftproductId();

    /**
     * Set mksoftproduct_id
     * @param string $mksoftproductId
     * @return \Mksoft\Import\Api\Data\MksoftProductInterface
     */
    public function setMksoftproductId($mksoftproductId);

    /**
     * Get title
     * @return string|null
     */
    public function getTitle();

    /**
     * Set title
     * @param string $title
     * @return \Mksoft\Import\Api\Data\MksoftProductInterface
     */
    public function setTitle($title);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Mksoft\Import\Api\Data\MksoftProductExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Mksoft\Import\Api\Data\MksoftProductExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Mksoft\Import\Api\Data\MksoftProductExtensionInterface $extensionAttributes
    );

    /**
     * Get plu
     * @return string|null
     */
    public function getPlu();

    /**
     * Set plu
     * @param string $plu
     * @return \Mksoft\Import\Api\Data\MksoftProductInterface
     */
    public function setPlu($plu);

    /**
     * Get ean
     * @return string|null
     */
    public function getEan();

    /**
     * Set ean
     * @param string $ean
     * @return \Mksoft\Import\Api\Data\MksoftProductInterface
     */
    public function setEan($ean);

    /**
     * Get old_price
     * @return string|null
     */
    public function getOldPrice();

    /**
     * Set old_price
     * @param string $oldPrice
     * @return \Mksoft\Import\Api\Data\MksoftProductInterface
     */
    public function setOldPrice($oldPrice);

    /**
     * Get price
     * @return string|null
     */
    public function getPrice();

    /**
     * Set price
     * @param string $price
     * @return \Mksoft\Import\Api\Data\MksoftProductInterface
     */
    public function setPrice($price);

    /**
     * Get entity_ids
     * @return string|null
     */
    public function getEntityIds();

    /**
     * Set entity_ids
     * @param string $entityIds
     * @return \Mksoft\Import\Api\Data\MksoftProductInterface
     */
    public function setEntityIds($entityIds);

    /**
     * Get updated_at
     * @return string
     */
    public function getUpdatedAt();

}

