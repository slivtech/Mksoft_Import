<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Mksoft\Import\Model\ResourceModel\MksoftProduct;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'mksoftproduct_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Mksoft\Import\Model\MksoftProduct::class,
            \Mksoft\Import\Model\ResourceModel\MksoftProduct::class
        );
    }
}

