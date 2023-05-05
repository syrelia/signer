<?php

namespace Syrelia\Test\Unit;

use PHPUnit\Framework\TestCase;
use Syrelia\Auth\Payload;
use Syrelia\Auth\Signer;

class SignerTest extends TestCase {

	const MOCKED_KEY = "super_key";

	public function __construct($name = null, array $data = array(), $dataName = '')
	{
		parent::__construct($name, $data, $dataName);

		$this->payload = Payload::create(array(
			"username" => "admin",
			"range"	   => "gold",
			"time"     => time()
		));

	}

	public function testVerify() {

		$auth = Signer::create($this->payload, self::MOCKED_KEY);

		$payload = $auth->verify(self::MOCKED_KEY, function ($payload) {
				return $payload;
			}, []
		);

		// Comprobamos que el método devuelve false para un número negativo
		$this->assertObjectHasAttribute('username', $payload);
		$this->assertObjectNotHasAttribute('password', $payload);

	}
}
