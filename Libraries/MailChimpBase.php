<?php

/**
 * Created by Jacky.
 * User: Jacky
 * E-Mail: jacky@carocrm.com or jacky@youaddon.com
 * Date: 8/5/2015
 * Time: 10:26 AM
 * Project: MailChimpAPI
 * File: MailChimpBase.php
 */
class MailChimpBase
{
    protected $api_key;
    protected $api_endpoint = API_ENDPOINT;
    protected $verify_ssl = VERIFY_SSL;

    /**
     * Input mailchimp api key
     *   get api key
     *   go to mailchimp account -> extras -> API Keys -> Create A Key -> API Key
     * In key have prefix "-" last string is data center. This string will add to api link: api_endpoint
     *
     * @param string $api_key MailChimp API Key
     */
    public function __construct($api_key)
    {
        $this->api_key = $api_key;
        list(, $data_center) = explode('-', $this->api_key);
        $this->api_endpoint = str_replace('<dc>', $data_center, $this->api_endpoint);
    }

    /**
     * Set a new key when request
     *
     * @param string $api_key MailChimp API Key
     */
    public function setApiKey($api_key)
    {
        $this->api_key = $api_key;
    }

    /**
     * Set ssl yes or no
     *
     * @param boolean $verify_ssl
     */
    public function setVerifySsl($verify_ssl)
    {
        $this->verify_ssl = $verify_ssl;
    }

    /**
     * Get API Key
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->api_key;
    }

    /**
     * Get API endpoint
     *
     * @return string
     */
    public function getApiEndpoint()
    {
        return $this->api_endpoint;
    }

    /**
     * Check your config have ssl
     *
     * @return boolean
     */
    public function isVerifySsl()
    {
        return $this->verify_ssl;
    }

    /**
     * Call REST Request
     * use CURL
     *
     * @param string $request_method GET POST DELETE PUT PATCH
     * @param string $method The API method to be called
     * @param array $args Assoc array of parameters to be passed
     * @param int $timeout request timeout
     * @return array Assoc array of decoded result
     */
    private function _REST_Request($request_method, $method, $args = array(), $timeout = 10)
    {
        $url = $this->api_endpoint . $method;

        $json_data = json_encode($args);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERPWD, "apiKey:" . $this->api_key);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-MCAPI/3.0');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $request_method);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $this->verify_ssl);

        if (!empty($args)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        }

        $result = curl_exec($ch);
        curl_close($ch);

        return $result ? json_decode($result, true) : false;
    }

    /**
     * Call an API method.
     *
     * @param string $request_method GET POST DELETE PUT PATCH
     * @param string $method The API method to call, e.g. 'lists/list'
     * @param array $args An array of arguments to pass to the method.
     * @param int $timeout request time out
     * @return array Associative array of json decoded API response.
     */
    public function call($request_method, $method, $args = array(), $timeout = 10)
    {
        return $this->_REST_Request($request_method, $method, $args, $timeout);
    }

    /**
     * Validates Your MailChimp API Key
     */
    public function validateApiKey()
    {
        $request = $this->call('GET', 'helper/ping');
        return !empty($request);
    }

    /**
     * Load class in libraries
     *
     * @param $class_name
     * @return bool
     */
    public function load($class_name)
    {
        require_once 'Libraries/' . $class_name . '.php';
        if (class_exists($class_name)) {
            return new $class_name($this->api_key);
        }

        return false;
    }

}