<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Mksoft\Import\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface MksoftProductRepositoryInterface
{

    /**
     * Save MksoftProduct
     * @param \Mksoft\Import\Api\Data\MksoftProductInterface $mksoftProduct
     * @return \Mksoft\Import\Api\Data\MksoftProductInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Mksoft\Import\Api\Data\MksoftProductInterface $mksoftProduct
    );

    /**
     * Retrieve MksoftProduct
     * @param string $mksoftproductId
     * @return \Mksoft\Import\Api\Data\MksoftProductInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($mksoftproductId);

    /**
     * Retrieve MksoftProduct by plu
     * @param int $plu
     * @return \Mksoft\Import\Api\Data\MksoftProductInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getByPlu($plu);

    /**
     * Retrieve MksoftProduct matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Mksoft\Import\Api\Data\MksoftProductSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete MksoftProduct
     * @param \Mksoft\Import\Api\Data\MksoftProductInterface $mksoftProduct
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Mksoft\Import\Api\Data\MksoftProductInterface $mksoftProduct
    );

    /**
     * Delete MksoftProduct by ID
     * @param string $mksoftproductId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($mksoftproductId);
}

