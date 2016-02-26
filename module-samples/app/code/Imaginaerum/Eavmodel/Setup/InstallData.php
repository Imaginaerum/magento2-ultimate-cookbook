<?php

namespace Imaginaerum\Eavmodel\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface {

    private $myeaventitySetupFactory;
    private $myeaventityFactory;

    public function __construct(
    \Imaginaerum\Eavmodel\Setup\MyeaventitySetupFactory $myeaventitySetupFactory, \Imaginaerum\Eavmodel\Model\MyeaventityFactory $myeaventityFactory
    ) {
        $this->myeaventitySetupFactory = $myeaventitySetupFactory;
        $this->myeaventityFactory = $myeaventityFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context) {
        $setup->startSetup();
        $myeaventityEntity = \Imaginaerum\Eavmodel\Model\Myeaventity::ENTITY;
        $myeaventitySetup = $this->myeaventitySetupFactory->create(['setup' => $setup]);
        $myeaventitySetup->installEntities();
        $myeaventitySetup->addAttribute(
                $myeaventityEntity, 'name', ['type' => 'varchar']
        );
        $myeaventitySetup->addAttribute(
                $myeaventityEntity, 'description', ['type' => 'text']
        );

        /**
         * Insertion de sample
         */
        $myeaventity = $this->myeaventityFactory->create();
        $myeaventity->setCode('code 1');
        $myeaventity->setName('John Doe');
        $myeaventity->setDescription('Incredible description !');
        $myeaventity->save();

        $setup->endSetup();
    }

}
