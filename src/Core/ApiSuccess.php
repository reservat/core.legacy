<?php

namespace Reservat\Core;

class ApiSuccess extends ApiResponse
{

    protected $code = '200';
    protected $data = [];

    public function buildBody()
    {

        $body = [
        'status' => $this->getCode(),
        'data' => $this->getData()
        ];

        return $body;

    }
}
