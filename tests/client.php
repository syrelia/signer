<?php

require_once './vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$jwt_secret_key = 'secret_key';

$file	 = './jwt.json';
$jwt = file_get_contents($file);
$jwt = implode('.', json_decode($jwt));
$jwt_alg_key    = "HS256";

try {

	$token_payload = JWT::decode(
		$jwt, new Key(
			$jwt_secret_key, 'HS256'
		)
	);

	print_r(
		(object) $token_payload
	);

} catch (Exception $e) {

}