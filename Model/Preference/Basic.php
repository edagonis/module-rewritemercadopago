<?php

namespace Avanti\RewriteMercadoPago\Model\Preference;

use MercadoPago\Core\Helper\ConfigData;
use Magento\Store\Model\ScopeInterface;

const PATH_TITLE = 'rewritemercadopago/general/auth_token';

class Basic extends \MercadoPago\Core\Model\Preference\Basic
{

    /**
     * @return array
     * @throws Exception
     */
    protected function getConfig()
    {
        $config = parent::getConfig();

        var_dump($this->_scopeConfig->getValue(PATH_TITLE, ScopeInterface::SCOPE_STORE));die;
        
        return $config;
    }
}