<?php

namespace App\Helpers;

class EncryptionUtil
{
    public static function encryptData($data, $password)
    {
        $method = 'aes-256-gcm';
        $salt = random_bytes(16);
        $nonce = random_bytes(openssl_cipher_iv_length($method));
        $key = sodium_crypto_pwhash(
            32,
            $password,
            $salt,
            SODIUM_CRYPTO_PWHASH_OPSLIMIT_INTERACTIVE,
            SODIUM_CRYPTO_PWHASH_MEMLIMIT_INTERACTIVE
        );
        $ciphertext = openssl_encrypt($data, $method, $key, OPENSSL_RAW_DATA, $nonce, $tag);
        $encryptedData = base64_encode($salt . $nonce . $tag . $ciphertext);
        return $encryptedData;
    }

    public static function decryptData($encryptedData, $password)
    {
        $method = 'aes-256-gcm';
        $decodedData = base64_decode($encryptedData);
        $salt = substr($decodedData, 0, 16);
        $nonce = substr($decodedData, 16, openssl_cipher_iv_length($method));
        $tag = substr($decodedData, 16 + openssl_cipher_iv_length($method), 16);
        $ciphertext = substr($decodedData, 16 + openssl_cipher_iv_length($method) + 16);
        $key = sodium_crypto_pwhash(
            32,
            $password,
            $salt,
            SODIUM_CRYPTO_PWHASH_OPSLIMIT_INTERACTIVE,
            SODIUM_CRYPTO_PWHASH_MEMLIMIT_INTERACTIVE
        );
        $decryptedData = openssl_decrypt($ciphertext, $method, $key, OPENSSL_RAW_DATA, $nonce, $tag);
        return $decryptedData;
    }
}
