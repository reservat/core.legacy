<?php

namespace Reservat\Core\Interfaces;

interface ESRepositoryInterface
{
    public function getById($id);
    public function getAll();
}
