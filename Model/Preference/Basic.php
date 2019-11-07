<?php

namespace Avanti\RewriteMercadoPago\Model\Preference;

use MercadoPago\Core\Helper\ConfigData;
use Magento\Store\Model\ScopeInterface;

class Basic extends \MercadoPago\Core\Model\Preference\Basic
{
    /**
     * @return array
     * @throws Exception
     */
    protected function getConfig()
    {
        $config = parent::getConfig();
        
        return $config;
    }
}