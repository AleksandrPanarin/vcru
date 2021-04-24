<?php

namespace App\System;

class Request
{
    const HTTP_METHOD_GET = 'GET';
    const HTTP_METHOD_POST = 'POST';
    const HTTP_METHOD_PUT = 'PUT';
    const HTTP_METHOD_PATCH = 'PATCH';

    /**
     * @var string
     */
    private $requestMethod;
    /**
     * @var array
     */
    private $queryParams = [];
    /**
     * @var array
     */
    private $data = [];

    public function __construct()
    {
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
        $this->initGetParams();
        $this->initPostPutPatchData();
    }

    private function initGetParams(): void
    {
        if ($this->requestMethod == self::HTTP_METHOD_GET) {
            $url_components = parse_url($_SERVER['REQUEST_URI']);
            if (isset($url_components['query'])) {
                parse_str($url_components['query'], $params);
                $this->queryParams = $params;
            }
        }
    }

    private function initPostPutPatchData()
    {
        $isValidMethod = in_array($this->requestMethod, [
            self::HTTP_METHOD_POST,
            self::HTTP_METHOD_PUT,
            self::HTTP_METHOD_PATCH
        ]);
        if ($isValidMethod) {
            if (json_decode(file_get_contents("php://input"), true)) {
                $this->data = json_decode(file_get_contents("php://input"), true);
            } else {
                $this->data = $_POST;
            }
        }

        if ($isValidMethod && $_FILES) {
            $this->data = array_merge($this->data, $_FILES);
        }
    }

    /**
     * @return array
     */
    public function getQueryParams(): array
    {
        return $this->queryParams;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}