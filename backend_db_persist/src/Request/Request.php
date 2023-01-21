<?php 

namespace App\Request;

class Request
{
    //private $headers;

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

    /*public function getHeaders(): array
    {
        return $this->headers;
    }*/

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
}
