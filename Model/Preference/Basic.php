<?php

namespace Avanti\RewriteMercadoPago\Model\Preference;

use MercadoPago\Core\Helper\ConfigData;
use Magento\Store\Model\ScopeInterface;

const PATH_TITLE = 'rewritemercadopago/general/auth_token';

const ALL_STATES = array(
    "AC" => "Acre",
    "AL" => "Alagoas",
    "AM" => "Amazonas",
    "AP" => "Amapá",
    "BA" => "Bahia",
    "CE" => "Ceará",
    "DF" => "Distrito Federal",
    "ES" => "Espírito Santo",
    "GO" => "Goiás",
    "MA" => "Maranhão",
    "MG" => "Minas Gerais",
    "MS" => "Mato Grosso do Sul",
    "MT" => "Mato Grosso",
    "PA" => "Pará",
    "PB" => "Paraíba",
    "PE" => "Pernambuco",
    "PI" => "Piauí",
    "PR" => "Paraná",
    "RJ" => "Rio de Janeiro",
    "RN" => "Rio Grande do Norte",
    "RO" => "Rondônia",
    "RR" => "Roraima",
    "RS" => "Rio Grande do Sul",
    "SC" => "Santa Catarina",
    "SE" => "Sergipe",
    "SP" => "São Paulo",
    "TO" => "Tocantins",
);

const MAPPED_REGIONS = array(
    0 => array(
        'name' => 'Sul',
        'states' => ['teste', 'wtf']
    )
);

class Basic extends \MercadoPago\Core\Model\Preference\Basic
{

    /**
     * @return array
     * @throws Exception
     */
    protected function getConfig()
    {
        $config = parent::getConfig();

        var_dump(MAPPED_REGIONS);die;
        var_dump($this->_scopeConfig->getValue(PATH_TITLE, ScopeInterface::SCOPE_STORE));die;
        
        return $config;
    }
}