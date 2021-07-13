<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare( strict_types=1 );

namespace Mksoft\Import\Console\Command;

use Mksoft\Import\Model\MagentoAttribute;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateProductAttributes extends Command {
    private MagentoAttribute $_magentoAttributeModel;

    public function __construct(
        MagentoAttribute $_magentoAttributeModel,
        string $name = null
    ) {
        $this->_magentoAttributeModel = $_magentoAttributeModel;
        parent::__construct( $name );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ) {
        $updatedTotal = $this->_magentoAttributeModel->updateProductAttributes();
        $output->writeln( "Updated {$updatedTotal} products." );
    }

    /**
     * {@inheritdoc}
     */
    protected function configure() {
        $this->setName( "mksoft_import:update_attr" );
        $this->setDescription( "Update attributes from mksoft_products table if updated" );
        parent::configure();
    }
}

