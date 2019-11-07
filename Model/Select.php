<?php

namespace Avanti\RewriteMercadoPago\Model;

class Select implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        $options = [
            [
                'label' => __('-- Please select --'),
                'value' => '',
            ],
            [
                'label' => __('Male'),
                'value' => '1',
            ],
            [
                'label' => __('Female'),
                'value' => '2',
            ],
            [
                'label' => __('????'),
                'value' => '3',
            ],
        ];
        return $options;
    }
}