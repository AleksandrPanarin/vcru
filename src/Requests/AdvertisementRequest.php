<?php

namespace App\Requests;

use Rakit\Validation\Validator;

class AdvertisementRequest extends BaseRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'text' => 'required',
            'price' => 'required|numeric',
            'amount' => 'required|numeric',
            'banner' => 'required|uploaded_file:0,10Mb,jpg,png,jpeg'
        ];
    }
}