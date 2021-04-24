<?php

namespace App\Requests;

use Rakit\Validation\Validator;

/**
 * Class BaseRequest
 */
abstract class BaseRequest
{
    /**
     * @var array
     */
    protected $requestData;

    /**
     * @var array
     */
    protected $errors;

    /**
     * @var Validator
     */
    private $validator;

    /**
     * BaseRequest constructor.
     * @param array $requestData
     */
    public function __construct(array $requestData)
    {
        $this->requestData = $requestData;
        $this->errors = [];
        $this->validator = new Validator();
    }

    /**
     * @return array
     */
    public abstract function rules(): array;

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        $validation = $this->getNewValidator()->make($this->requestData, $this->rules());
        $validation->validate();
        if ($validation->fails()) {
            $this->errors = $validation->errors()->toArray();
            return false;
        }
        return true;
    }

    /**
     * @return Validator
     */
    public function getNewValidator(): Validator
    {
        return clone $this->validator;
    }

    /**
     * @return Validator
     */
    public function getValidator(): Validator
    {
        return $this->validator;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}