<?php 

namespace App\Request;

class Request
{
    private $headers;
    private static $url = "http://jsonplaceholder.typicode.com/";

    public function __construct()
    {
        //$this->headers = apache_request_headers();
    }

    public function getQueryParams(): array
    {
        return $_GET;
    }

    public function getPostData(): array
    {
        return json_decode(file_get_contents("php://input"), true);
    }

    public function getParams()
    {
        $params = [];
        if ($this->isGet()) {
            $params = $this->getQueryParams();
        } elseif ($this->isPost()) {
            $params = $this->getPostData();
        }
        return $params;
    }

    public function getHeader(string $header): ?string
    {
        return $this->headers[$header] ?? null;
    }

    public function getUri(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function isPost(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    public function isGet(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    public function isPut(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'PUT';
    }

    public function isDelete(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'DELETE';
    }

    public static function makeRequest($method, $endpoint, $data = null) {

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, static::$url.$endpoint);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);

        $httpHeader = ['Content-Type: application/json'];
        if ($data) {
            $dataString = json_encode($data);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $dataString);
            $httpHeader[] = 'Content-Length: ' . strlen($data_string);
        }

        $response = curl_exec($curl);
   
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($status != 200) {
            // handle error
        }

        curl_close($curl);
        return $response;
    }
}
