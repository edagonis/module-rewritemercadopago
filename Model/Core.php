<?php

namespace Avanti\RewriteMercadoPago\Model;

use Magento\Store\Model\ScopeInterface;

const ADMIN_CREDENTIALS_PATH = 'rewritemercadopago/authentication/';

class Core extends \MercadoPago\Core\Model\Core
{
    /**
     * Get the access token from configs based on the customer address state
     * 
     * @param $preference
     * 
     * @return string||boolean
     */
    public function getAccessTokenFromCustomerAddress($preference)
    {
        /**
         * Does nothing if there is no address key on the preference
         */
        if (!array_key_exists('payer', $preference) || !array_key_exists('address', $preference['payer'])) return false;

        $address = $preference['payer']['address'];
        $state = $address['federal_unit'] ?: false;

        if (!$state) return false;

        /**
         * Merges states added on admin configuration into credentials paths
         */
        $mappedCredentialsByState = array();
        for($i = 1; $i <= 3; $i++) {
            $regionStates = $this->_scopeConfig->getValue(ADMIN_CREDENTIALS_PATH . 'region' . $i . '/states', ScopeInterface::SCOPE_STORE);
            $regionStatesArray = explode(',', trim($regionStates));

            $mappedCredentialsByState['region' . $i . '/auth_token'] = $regionStatesArray;
        }

        $this->_coreHelper->log("mappedCredentialsByState", 'mercadopago-custom.log', $mappedCredentialsByState);

        /**
         * Finds the path to an access token based on a address state
         */
        $accessTokenPath = null;
        foreach($mappedCredentialsByState as $path => $states) {
            if (array_search($state, $states) !== false) {
                $accessTokenPath = $path;
                break;
            }
        }

        $accessToken = $this->_scopeConfig->getValue(ADMIN_CREDENTIALS_PATH . $accessTokenPath, ScopeInterface::SCOPE_STORE);

        $this->_coreHelper->log("Access token from customer address", 'mercadopago-custom.log', $accessToken);

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
        $this->_accessToken = $this->getAccessTokenFromCustomerAddress($preference);

        $response = parent::postPaymentV1($preference);

        return $response;
    }
}