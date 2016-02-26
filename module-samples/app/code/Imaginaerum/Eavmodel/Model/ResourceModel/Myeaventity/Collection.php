<?php

namespace Imaginaerum\Eavmodel\Model\ResourceModel\Myeaventity;

class Collection extends \Magento\Eav\Model\Entity\Collection\AbstractCollection {

    protected function _construct() {
        $this->_init('Imaginaerum\Eavmodel\Model\Myeaventity', 'Imaginaerum\Eavmodel\Model\ResourceModel\Myeaventity');
    }

}
