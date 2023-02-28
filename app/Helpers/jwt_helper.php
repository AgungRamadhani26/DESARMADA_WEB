<?php

use App\Models\OtentikasiAPI;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function getJWT($otentikasiHeader)
{
  if (is_null($otentikasiHeader)) {
    throw new Exception("Autentikasi JWT Gagal!");
  }
  return explode(" ", $otentikasiHeader)[1];
}

function validateJWT($encodedToken)
{
  $key = getenv('JWT_SECRET_KEY');
  $decodedToken = JWT::decode($encodedToken, new Key($key, 'HS256'));
  $modelOtentikasi = new OtentikasiAPI();
  $modelOtentikasi->get_username($decodedToken->username);
}

function createJWT($username)
{
  $waktuRequest = time();
  $waktuToken = getenv('JWT_TIME_TO_LIVE');
  $waktuExpired = $waktuRequest + $waktuToken;
  $payload = [
    'username' => $username,
    'iat' => $waktuRequest,
    'exp' => $waktuExpired,
  ];
  $jwt = JWT::encode($payload, getenv('JWT_SECRET_KEY'), 'HS256');
  return $jwt;
}
