<?php
/** set your paypal credential **/

$config['client_id'] = 'Afq9HtbP-u0G1dcEITFSpDF0P4dXUrkQOS4eTzpdsuJBzqZwnHpObwQFnx58sK9Esn8KfU4O_M8ana_u';
$config['secret'] = 'EIIn4CbrlJ2__mnKpzZgButAX1EDAHYvsn4AmtI5QnKGnZwbchwmEsEmlX9URzDa1pDQdiArhoZ-Z1xa';

/**
 * SDK configuration
 */
/**
 * Available option 'sandbox' or 'live'
 */
$config['settings'] = array(

    'mode' => 'sandbox',
    /**
     * Specify the max request time in seconds
     */
    'http.ConnectionTimeOut' => 1000,
    /**
     * Whether want to log to a file
     */
    'log.LogEnabled' => true,
    /**
     * Specify the file that want to write on
     */
    'log.FileName' => 'application/logs/paypal.log',
    /**
     * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
     *
     * Logging is most verbose in the 'FINE' level and decreases as you
     * proceed towards ERROR
     */
    'log.LogLevel' => 'FINE'
);