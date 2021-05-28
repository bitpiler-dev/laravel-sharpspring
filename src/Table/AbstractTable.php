<?php


namespace Bitpiler\LaravelSharpspring\Table;


use GuzzleHttp\Client;

abstract class AbstractTable
{
    /**
     * The Guzzle Client.
     *
     * @var \GuzzleHttp\Client
     */
    protected $client;


    /**
     * Assign the client to the Basecamp API Section.
     *
     * @param \GuzzleHttp\Client $client
     * @return void
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Return the formatted json response to a collection.
     *
     * @param \GuzzleHttp\Psr7\Response $response
     * @return \Illuminate\Support\Collection
     */
    public function response($response)
    {
        return json_decode($response->getBody());
    }

    public function call($methodName, $params = []): \Psr\Http\Message\ResponseInterface
    {
        $requestID = session_id();

        $payload = array(
            'method' => $methodName,
            'params' => $params,
            'id'     => $requestID,
        );

        $headers = [
            'Content-Type'   => 'application/json',
            'Content-Length' => strlen(json_encode($payload))
        ];

        $response = $this->client->post('/pubapi/v1/', [
            'headers' => $headers,
            'json'    => $payload
        ]);


        return $response;
    }
}
