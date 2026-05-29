<?php

require_once 'classes/Encryption.php';

$enc = new Encryption();

$encrypted = $enc->encrypt("hello", "mypassword");

echo "Encrypted: " . $encrypted . "<br>";

echo "Decrypted: " .
     $enc->decrypt($encrypted, "mypassword");