<?php

namespace Syrelia\Auth;

class PayloadException extends \Exception {

	public static function createFromEmptyPayload() {
		return new self(
			"El payload no contiene ningún valor"
		);
	}

}