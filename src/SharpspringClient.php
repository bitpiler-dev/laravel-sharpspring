<?php


namespace Bitpiler\LaravelSharpspring;


use GuzzleHttp\Client;
use ReflectionClass;

class SharpspringClient
{
    /**
     * The Http Client.
     *
     * @var \GuzzleHttp\Client
     */
    protected $httpClient;

    /**
     * The Client configuration.
     *
     * @var array
     */
    public $config;

    /**
     * Start the basecamp client.
     *
     * @param  array $config
     * @return void
     */
    public function __construct($config)
    {
        $this->config = $config;
        $this->init();
    }

    public function init()
    {
        $base_uri = "https://api.sharpspring.com";

        $query = [
            'accountID' => $this->config['app_id'],
            'secretKey' => $this->config['app_secret'],
        ];

        $this->httpClient = new Client([
            'base_uri' => $base_uri,
            'query'  => $query
        ]);

        return $this;
    }

    /**
     * Get the Http Client.
     *
     * @return \GuzzleHttp\Client
     */
    public function getHttpClient()
    {
        if (is_null($this->httpClient)) {
            $this->init();
        }

        return $this->httpClient;
    }

    /**
     * Dispatch to a Basecamp API section.
     *
     */
    public function __call($class, $parameters)
    {
        $className = __NAMESPACE__.'\\Tables\\'.ucfirst($class);

        if (class_exists($className)) {
            return call_user_func_array(array(
                new ReflectionClass($className), 'newInstance'
            ), array($this->getHttpClient(), $parameters));
        }
    }
}
