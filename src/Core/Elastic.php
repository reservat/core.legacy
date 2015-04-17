<?php

namespace Reservat\Core;

use Elasticsearch\Client;

class Elastic
{

    public function __construct($di)
    {
        $config = $di->get('config');
        $params = ['hosts' => ['http://'.$config->ES_USER.':'.$config->ES_PASSWORD.'@'.$config->ES_HOST]];
        $this->_client = new Client($params);
    }

    public function getClient()
    {
        return $this->_client;
    }
}
