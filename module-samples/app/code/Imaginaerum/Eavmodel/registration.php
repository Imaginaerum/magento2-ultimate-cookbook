<?php

/**
 * Ce fichier est necessaire...
 * Il permet d'enregistrer notre module dans Magento
 */
$register = \Magento\Framework\Component\ComponentRegistrar::MODULE;
\Magento\Framework\Component\ComponentRegistrar::register($register, 'Imaginaerum_Eavmodel', __DIR__);
