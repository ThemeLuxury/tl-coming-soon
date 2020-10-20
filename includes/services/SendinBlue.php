<?php

/**
 * SendinBlue API client library
**/
class SendinBlue
{
    private $api_key;
    private $api_url = 'https://api.sendinblue.com/v3';
    private $timeout = 10;
    public $http_status;

    /**
     * Set api key and optionally API endpoint
    **/
    public function __construct($api_key, $api_url = null)
    {
        $this->api_key = $api_key;

        if (!empty($api_url)) {
            $this->api_url = $api_url;
        }
    }

    /**
     * Get All Lists
    **/
    public function getLists()
    {
        return $this->makeRequest('/contacts/lists?limit=10&offset=0');
    }

    /**
     * Add a New Subscribe
    **/
    public function addContact($params)
    {
    	return $this->makeRequest('/contacts', 'POST', $params);
    }

    /**
     * cURL make request
    **/
    private function makeRequest($api_method = null, $http_method = 'GET', $params = array())
    {
        if (empty($api_method)) {
            return (object)array(
                'httpStatus' => '400',
                'code' => '1010',
                'codeDescription' => 'Error in external resources',
                'message' => 'Invalid api method'
            );
        }

        $params = json_encode($params);

        $url = $this->api_url . '/' . $api_method;

        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_ENCODING => 'gzip,deflate',
            CURLOPT_FRESH_CONNECT => 1,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_TIMEOUT => $this->timeout,
            CURLOPT_HEADER => false,
            CURLOPT_USERAGENT => $_SERVER['HTTP_USER_AGENT'],
            CURLOPT_HTTPHEADER => array('accept: application/json', 'api-key: ' . $this->api_key, 'content-type: application/json' )
        );

        if ($http_method == 'POST') {
            $options[CURLOPT_POST] = true;
            $options[CURLOPT_POSTFIELDS] = $params;
        }

        $curl = curl_init();

        curl_setopt_array($curl, $options);

        $response = json_decode(curl_exec($curl));

        $this->http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        return (object)$response;
    }

    //End scripts.

}