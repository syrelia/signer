<?php

namespace Syrelia\Auth;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Signer {

	// todo añadir más opciones de algoritmo
	const JWT_ALG_HS256 = "HS256";

	private $token;

	public function __construct($payload, $key) {

		$value = $payload->value();
		if (!isset($value)) {
			throw PayloadException::createFromEmptyPayload();
		}

		$this->encode($value, $key);

	}

	private function encode($value, $key) {
		$this->token = JWT::encode(
			$value, $key, self::JWT_ALG_HS256
		);
	}

	public static function create(Payload $payload, $key) {
		return new self($payload, $key);
	}

	public function update($payload, $key) {
		$this->encode($payload, $key);
	}

	public function verify($key, callable $callback, array $args = null) {

		// decodifica el token
		$payload = JWT::decode(
			// abstraemos para evitar conocer que hay que enviar un objeto de tipo key de JWT
			$this->token, new Key(
				$key, self::JWT_ALG_HS256
			)
		);

		// y validamos contra una validación indicada por el cliente
		return $callback($payload, $args);
	}

}