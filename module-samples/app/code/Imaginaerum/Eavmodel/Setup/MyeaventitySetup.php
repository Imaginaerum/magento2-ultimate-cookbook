<?php

namespace Imaginaerum\Eavmodel\Setup;

use Magento\Eav\Setup\EavSetup;

class MyeaventitySetup extends EavSetup {

    public function getDefaultEntities() {
        $entity = \Imaginaerum\Eavmodel\Model\Myeaventity::ENTITY;
        $entities = [
            $entity => [
                'entity_model' => 'Imaginaerum\Eavmodel\Model\ResourceModel\Myeaventity',
                'table' => $entity . '_entity',
                'attributes' => [
                    'code' => [
                        'type' => 'static',
                    ],
                ],
            ],
        ];
        return $entities;
    }

}
