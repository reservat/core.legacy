<?php

namespace Reservat\Core;

class ApiError extends ApiResponse 
{

	protected $_code = '400';

	public function buildBody()
	{

		$errors = [];

		foreach($this->getData() as $error){
			if($error->field){
				$errors[$error->field] = $error;
			} else {
				$errors[] = $error;
			}
		}

		$body = [
			'status' => $this->getCode(),
			'errors' => $errors
		];

		return $body;

	}
	
}