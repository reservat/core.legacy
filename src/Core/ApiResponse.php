<?php

namespace Reservat\Core;

abstract class ApiResponse
{

    protected $data = [];
    protected $code = 200;

    public function __construct($data, $code = false)
    {
        $this->_data = $data;
        if ($code) {
            $this->code = $code;
        }
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getData()
    {
        return $this->data;
    }

    public function serve($res)
    {
        $res->code($this->getCode());
        $res->json($this->buildBody());
        $res->send();
    }

    public static function build($data, $code = false)
    {
        return new static($data, $code);
    }
}
