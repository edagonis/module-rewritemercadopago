<?php

namespace Avanti\RewriteMercadoPago\Model;

use Magento\Store\Model\ScopeInterface;

const ADMIN_CREDENTIALS_PATH = 'rewritemercadopago/general/';

const STATES_BY_REGIONS = array(
    ["AC", "AL", "AM", "AP", "BA", "CE", "DF", "ES", "GO"],
    ["MA", "MG", "MS", "MT", "PA", "PB", "PE", "PI", "PR"],
    ["RJ", "RN", "RO", "RR", "RS", "SC", "SE", "SP", "TO"]
)

const MAPPED_CREDENTIALS_PATH_BY_STATE = array(
    'auth_token_region1' => STATES_BY_REGIONS[0],
    'auth_token_region2' => STATES_BY_REGIONS[1],
    'auth_token_region3' => STATES_BY_REGIONS[2]
);

class Core extends \MercadoPago\Core\Model\Core
{
    /**
     * Get the access token from configs based on the customer address state
     * 
     * @param $preference
     * 
     * @return string||boolean
     */
    public function getAccessToken($preference)
    {
        /**
         * Does nothing if there is no address key on the preference
         */
        if (!array_key_exists('payer', $preference) || !array_key_exists('address', $preference['payer'])) return false;

        $address = $preference['payer']['address'];
        $state = $address['federal_unit'] ?: false

        if (!$state) return false

        $this->_coreHelper->log("Preference address federal_unit - ", 'mercadopago-custom.log', $state);

        /**
         * Finds the path to an access token based on a address state
         */
        $accessTokenPath = null;
        foreach(MAPPED_CREDENTIALS_PATH_BY_STATE as $path => $states) {
            if (array_search('SC', $states) !== false) {
                $accessTokenPath = $path;
                break;
            }
        }

        $accessToken = $this->_scopeConfig->getValue(ADMIN_CREDENTIALS_PATH . $accessTokenPath, ScopeInterface::SCOPE_STORE);

        die('wtf');
        return $accessToken;
    }

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
        $this->_accessToken = $this->getAccessToken($preference);

        $this->_coreHelper->log("Access Token for Post from rewrite - ", 'mercadopago-custom.log', $this->_accessToken);

        $response = parent::postPaymentV1($preference);

        return $response;
    }
}