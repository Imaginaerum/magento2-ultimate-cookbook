<?php

namespace Imaginaerum\Eavmodel\Model\ResourceModel;

class Myeaventity extends \Magento\Eav\Model\Entity\AbstractEntity {

    protected function _construct() {
        $this->_read = 'imaginaerum_eavmodel_myeaventity_read';
        $this->_write = 'imaginaerum_eavmodel_myeaventity_write';
    }

    public function getEntityType() {
        if (empty($this->_type)) {
            $this->setType(\Imaginaerum\Eavmodel\Model\Myeaventity::ENTITY);
        }
        return parent::getEntityType();
    }

}
