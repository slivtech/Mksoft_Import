<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Mksoft\Import\Model\Data;

use Mksoft\Import\Api\Data\MksoftProductInterface;

class MksoftProduct extends \Magento\Framework\Api\AbstractExtensibleObject implements MksoftProductInterface
{

    /**
     * Get mksoftproduct_id
     * @return string|null
     */
    public function getMksoftproductId()
    {
        return $this->_get(self::MKSOFTPRODUCT_ID);
    }

    /**
     * Set mksoftproduct_id
     * @param string $mksoftproductId
     * @return \Mksoft\Import\Api\Data\MksoftProductInterface
     */
    public function setMksoftproductId($mksoftproductId)
    {
        return $this->setData(self::MKSOFTPRODUCT_ID, $mksoftproductId);
    }

    /**
     * Get title
     * @return string|null
     */
    public function getTitle()
    {
        return $this->_get(self::TITLE);
    }

    /**
     * Set title
     * @param string $title
     * @return \Mksoft\Import\Api\Data\MksoftProductInterface
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Mksoft\Import\Api\Data\MksoftProductExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \Mksoft\Import\Api\Data\MksoftProductExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Mksoft\Import\Api\Data\MksoftProductExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get plu
     * @return string|null
     */
    public function getPlu()
    {
        return $this->_get(self::PLU);
    }

    /**
     * Set plu
     * @param string $plu
     * @return \Mksoft\Import\Api\Data\MksoftProductInterface
     */
    public function setPlu($plu)
    {
        return $this->setData(self::PLU, $plu);
    }

    /**
     * Get ean
     * @return string|null
     */
    public function getEan()
    {
        return $this->_get(self::EAN);
    }

    /**
     * Set ean
     * @param string $ean
     * @return \Mksoft\Import\Api\Data\MksoftProductInterface
     */
    public function setEan($ean)
    {
        return $this->setData(self::EAN, $ean);
    }

    /**
     * Get old_price
     * @return string|null
     */
    public function getOldPrice()
    {
        return $this->_get(self::OLD_PRICE);
    }

    /**
     * Set old_price
     * @param string $oldPrice
     * @return \Mksoft\Import\Api\Data\MksoftProductInterface
     */
    public function setOldPrice($oldPrice)
    {
        return $this->setData(self::OLD_PRICE, $oldPrice);
    }

    /**
     * Get price
     * @return string|null
     */
    public function getPrice()
    {
        return $this->_get(self::PRICE);
    }

    /**
     * Set price
     * @param string $price
     * @return \Mksoft\Import\Api\Data\MksoftProductInterface
     */
    public function setPrice($price)
    {
        return $this->setData(self::PRICE, $price);
    }

    /**
     * Get entity_ids
     * @return string|null
     */
    public function getEntityIds()
    {
        return $this->_get(self::ENTITY_IDS);
    }

    /**
     * Set entity_ids
     * @param string $entityIds
     * @return \Mksoft\Import\Api\Data\MksoftProductInterface
     */
    public function setEntityIds($entityIds)
    {
        return $this->setData(self::ENTITY_IDS, $entityIds);
    }

    /**
     * Get updated_at
     * @return string
     */
    public function getUpdatedAt() {
        return $this->_get(self::UPDATED_AT);
    }
}

