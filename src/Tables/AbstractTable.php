<?php


namespace Bitpiler\LaravelSharpspring\Tables;


use GuzzleHttp\Client;

abstract class AbstractTable
{

    protected $client;


    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @throws \Exception
     */
    public function response($response)
    {
        $data = json_decode($response->getBody());

        if ($data->error) {
            throw new \Exception($data->error->message, $data->error->code);
        }

        return $data;
    }

    public function call($methodName, $params = [])
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

        return $this->client->post('/pubapi/v1/', [
            'headers' => $headers,
            'json'    => $payload
        ]);
    }
}
