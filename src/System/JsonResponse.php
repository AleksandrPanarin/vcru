<?php


namespace App\System;


class JsonResponse
{
    public const HTTP_OK = 200;
    public const HTTP_CREATED = 201;
    public const HTTP_NO_CONTENT = 204;
    public const HTTP_BAD_REQUEST = 400;
    public const HTTP_INTERNAL_SERVER_ERROR = 500;

    /**
     * @var int
     */
    private $statusCode;
    /**
     * @var array
     */
    private $data;
    /**
     * @var array
     */
    private $headers;

    public function __construct(array $data, int $code = self::HTTP_OK, array $headers = [])
    {
        $this->data = $data;
        $this->statusCode = $code;
        $this->headers = array_merge(['Content-Type' => 'application/json'], $headers);
    }

    /**
     * @param array $data
     * @param int $status
     * @param array $headers
     * @return JsonResponse
     */
    public static function create(array $data, int $status = 200, array $headers = []): JsonResponse
    {
        return new self($data, $status, $headers);
    }

    /**
     * @param int $code
     * @return $this
     */
    public function setStatusCode(int $code): self
    {
        $this->statusCode = $code;

        return $this;
    }

    /**
     * @param array $headers
     * @return $this
     */
    public function setHeaders(array $headers): self
    {
        if ($headers) {
            $this->headers = array_merge($this->headers, $headers);
        }
        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        http_response_code($this->statusCode);
        if ($this->headers) {
            foreach ($this->headers as $header => $val) {
                header("{$header}: {$val}");
            }
        }
        $data = array_merge([
            'code' => $this->statusCode
        ], $this->data);
        return json_encode($data);
    }
}