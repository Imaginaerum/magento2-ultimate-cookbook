<?php

namespace Imaginaerum\Eavmodel\Model\ResourceModel\Myeaventity;

class Collection extends \Magento\Eav\Model\Entity\Collection\AbstractCollection {
    /**
     * La méthode _init du constructeur accepte 2 paramêtres qui sont le chemin vers notre modèle
     * et le chemin vers la ressource du modèle
     **/
    protected function _construct() {
        $this->_init('Imaginaerum\Eavmodel\Model\Myeaventity', 'Imaginaerum\Eavmodel\Model\ResourceModel\Myeaventity');
    }

}
