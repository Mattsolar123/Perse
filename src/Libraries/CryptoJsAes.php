<?php

namespace Mattsolar123\Perse\Libraries;

class CryptoJsAes
{
    /**
     * Decrypts a Crypto-JS AES encrypted string.
     *
     * @param string $encrypted Base64 encoded string from Crypto-JS
     * @param string $password The encryption key
     * @return string|false The decrypted string or false on failure
     */
    public static function decrypt(string $encrypted, string $password): string|false
    {
        $data = base64_decode($encrypted);

        // Crypto-JS prefixes the encrypted data with "Salted__" followed by the salt
        if (substr($data, 0, 8) !== "Salted__") {
            return false;
        }

        $salt = substr($data, 8, 8);
        $ct = substr($data, 16);

        // Correctly derive the key and IV using the OpenSSL EVP_BytesToKey equivalent logic
        $keyAndIv = '';
        $lastHash = '';
        while (strlen($keyAndIv) < 48) {
            $lastHash = hash('md5', $lastHash . $password . $salt, true);
            $keyAndIv .= $lastHash;
        }

        // The first 32 bytes of the derived bytes are the key (AES-256)
        $key = substr($keyAndIv, 0, 32);

        // The next 16 bytes are the IV
        $iv = substr($keyAndIv, 32, 16);

        // Decrypt the data using AES-256-CBC with the correct flags
        $decrypted = openssl_decrypt(
            $ct,
            'aes-256-cbc',
            $key,
            OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING,
            $iv
        );

        return $decrypted;
    }
}
