<?php

namespace app\tests;

use yii\httpclient\Client;

class MockServerHelper
{
    public const POST = 'POST';
    public const GET = 'GET';
    public const PUT = 'PUT';
    public const PATCH = 'PATCH';
    public const DELETE = 'DELETE';

    /**
     * @var string
     */
    public const MOCK_SERVER_URL = 'mock-server-bil-container:1096';

    public static function resetExpectations()
    {
        try {
            $mockServerUrl = sprintf('http://%s/mockserver/reset', self::MOCK_SERVER_URL);

            $client = new Client();
            $client->createRequest()
                ->setMethod('PUT')
                ->setUrl($mockServerUrl)
                ->send();
        } catch (\Exception $exception) {
            codecept_debug($exception->getMessage());
        }
    }

    /**
     * @param $method
     * @param $url
     * @param string $response
     * @param int    $responseStatusCode
     *
     * @return mixed
     */
    public static function mockRequest($method, $url, $response = '{}', $responseStatusCode = 200)
    {
        try {
            $mockServerUrl = sprintf('http://%s/mockserver/expectation', self::MOCK_SERVER_URL);
            $body = "[{
              \"httpRequest\" : {
                \"path\" : \"{$url}\",
                \"method\" : \"{$method}\"
              },
              \"httpResponse\" : {
                \"body\" : $response,
                \"statusCode\": $responseStatusCode
              }
            }]";

            $client = new Client();
            $client->createRequest()
                ->setMethod('PUT')
                ->setUrl($mockServerUrl)
                ->setHeaders(['Content-Type' => 'application/json'])
                ->setContent($body)
                ->send();
        } catch (\Exception $exception) {
            codecept_debug($exception->getMessage());
        }
    }
}
