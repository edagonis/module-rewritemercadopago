# module-rewritemercadopago

Magento 2 module that rewrites the MercadoPago/Core module

Currently it is enhancing the default configs, by allowing more authentication configurations on the admin panel

## installation

- Clone or download this repository

- Create the folders `Avanti/RewriteMercadoPago` inside `app/code` on a Magento 2 project

- Put the repository content inside `RewriteMercadoPago` folder

- Run `bin/magento setup:upgrade`

- Clean cache

## anotations

- To see which account the order has been connected to, check the response from the orders API, inside `payment.additional_information` and search for `collector_id`
