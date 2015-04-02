<?php

namespace Reservat\Core;

class ApiSuccess extends ApiResponse
{

	protected $_code = '200';
	protected $_data = [];

	public function buildBody()
	{

		$body = [
			'status' => $this->getCode(),
			'data' => $this->getData()
		];

		return $body;

	}

}