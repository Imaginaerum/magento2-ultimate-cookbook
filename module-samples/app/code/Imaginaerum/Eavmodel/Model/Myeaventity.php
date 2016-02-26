<?php

namespace Imaginaerum\Eavmodel\Model;

class Myeaventity extends \Magento\Framework\Model\AbstractModel {

    const ENTITY = 'imaginaerum_eavmodel_myeaventity';

    public function _construct() {
        $this->_init('Imaginaerum\Eavmodel\Model\ResourceModel\Myeaventity');
    }

}
