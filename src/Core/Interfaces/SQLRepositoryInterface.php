<?php

namespace Reservat\Core\Interfaces;

interface SQLRepositoryInterface 
{
	public function table();
	public function getById($id);
	public function getAll();
}