<?php

namespace Reservat\Core\Interfaces;

interface ManagerInterface
{

    public function getRepository();
    public function getEntity($args);
    public function getDatamapper();
}
