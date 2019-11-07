<?php

namespace Avanti\RewriteMercadoPago\Model;

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
        //get access_token
        if (!$this->_accessToken) {
            $this->_accessToken = $this->_scopeConfig->getValue(\MercadoPago\Core\Helper\ConfigData::PATH_ACCESS_TOKEN, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        }
        
        $this->_coreHelper->log("Access Token for Post", 'mercadopago-custom.log', $this->_accessToken);

        $this->_coreHelper->log("Using post payment rewrite", 'mercadopago-custom.log');
        //set sdk php mercadopago
        $mp = $this->_coreHelper->getApiInstance($this->_accessToken);

        $response = $mp->post("/v1/payments", $preference);

        return $response;
    }
}