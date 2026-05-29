<?php

require_once 'Encryption.php';

class PasswordRecord {

    private $conn;

    private Encryption $encryption;

    public function __construct($db){

        $this->conn = $db;

        $this->encryption =
        new Encryption();
    }

    public function savePassword(
    int $userId,
    string $website,
    string $websiteUser,
    string $password,
    string $realKey
    ): bool
{

        $encryptedPassword =
        $this->encryption->encrypt(
            $password,
            $realKey
        );

        $sql =
        "INSERT INTO passwords

        (user_id,
        website_name,
        website_username,
        encrypted_password)

        VALUES (?, ?, ?, ?)";

        $stmt =
        $this->conn->prepare($sql);

        return $stmt->execute([

            $userId,
            $website,
            $websiteUser,
            $encryptedPassword
        ]);
    }

    public function getPasswords(
        int $userId
    ){

        $sql =
        "SELECT * FROM passwords
        WHERE user_id=?";

        $stmt =
        $this->conn->prepare($sql);

        $stmt->execute([$userId]);

        return $stmt->fetchAll(
            PDO::FETCH_ASSOC
        );
    }
}
?>