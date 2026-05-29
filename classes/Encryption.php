<?php

class Encryption {

    private string $method = "AES-256-CBC";

    public function encrypt(string $data, string $password): string {

        $iv = random_bytes(16);

        $key = hash('sha256', $password, true);

        $encrypted = openssl_encrypt(
            $data,
            $this->method,
            $key,
            0,
            $iv
        );

        return base64_encode(
            $encrypted . "::" . $iv
        );
    }

    public function decrypt(string $data, string $password): string|false {

        $key = hash('sha256', $password, true);

        list($encrypted_data, $iv) =
            explode("::", base64_decode($data), 2);

        return openssl_decrypt(
            $encrypted_data,
            $this->method,
            $key,
            0,
            $iv
        );
    }
}