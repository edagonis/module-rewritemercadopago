<?php

namespace Avanti\RewriteMercadoPago\Model;

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
        'states' => ['Santa Catarina', 'Rio Grande do Sul']
    )
);

class Core extends \MercadoPago\Core\Model\Core
{

    /**
     * Return response of api to a preference
     *
     * @param $preference
     *
     * @return array
     * @throws \MercadoPago\Core\Model\Api\V1\Exception
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function postPaymentV1($preference)
    {
        $this->_accessToken = 'TESTE';

        $response = parent::postPaymentV1($preference);

        return $response;
    }
}