<?php

require_once 'Encryption.php';

class User {

    private $conn;

    private Encryption $encryption;

    public function __construct($db){

        $this->conn = $db;

        $this->encryption =
        new Encryption();
    }

    public function register(
    string $username,
    string $password
    ): bool
    {

        $passwordHash =
        password_hash(
            $password,
            PASSWORD_BCRYPT
        );

        // Permanent KEY
        $realKey =
        bin2hex(random_bytes(32));

        // Encrypt KEY
        $encryptedKey =
        $this->encryption->encrypt(
            $realKey,
            $password
        );

        $sql =
        "INSERT INTO users
        (username,
        password_hash,
        encrypted_key)

        VALUES (?, ?, ?)";

        $stmt =
        $this->conn->prepare($sql);

        return $stmt->execute([

            $username,
            $passwordHash,
            $encryptedKey
        ]);
    }

    public function login(
    string $username,
    string $password
    ): array|false
    {

        $sql =
        "SELECT * FROM users
        WHERE username=?";

        $stmt =
        $this->conn->prepare($sql);

        $stmt->execute([$username]);

        $user =
        $stmt->fetch(PDO::FETCH_ASSOC);

        if(
            $user &&
            password_verify(
                $password,
                $user['password_hash']
            )
        ){

            return $user;
        }

        return false;
    }
}
?>