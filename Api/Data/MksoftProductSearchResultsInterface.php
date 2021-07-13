<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Mksoft\Import\Api\Data;

interface MksoftProductSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get MksoftProduct list.
     * @return \Mksoft\Import\Api\Data\MksoftProductInterface[]
     */
    public function getItems();

    /**
     * Set title list.
     * @param \Mksoft\Import\Api\Data\MksoftProductInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

