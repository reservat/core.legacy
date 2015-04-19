<?php

namespace Reservat\Core\Interfaces;

interface ManagerInterface
{

    public function getRepository();
    public function getEntity();
    public function getDatamapper();
}
