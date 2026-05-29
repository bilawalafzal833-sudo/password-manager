**PHP OOP Password Manager**

**Project Overview**

This project is a Password Manager developed using PHP Object-Oriented Programming (OOP) and MySQL. The application allows users to securely generate, encrypt, store, and manage passwords for websites and applications.

The project was developed as part of a PHP OOP programming assignment.

**Features**

* User registration and login
* Password hashing using PHP `password_hash()`
* AES-256 encryption and decryption
* Permanent user encryption key generation
* Custom password generator
* Secure password storage
* MySQL database integration
* Dashboard for managing password records
* Git version control using GitHub

**Technologies Used**

PHP
MySQL
XAMPP
phpMyAdmin
Visual Studio Code
Git & GitHub
  
**Database**

Database Name:

password_manager

Tables:

**users**

* id
* username
* password_hash
* encrypted_key
* created_at

**passwords**

id
user_id
website_name
website_username
encrypted_password
created_at

**System Functionality**

1. Users can register an account.
2. Login passwords are stored as hashes.
3. A permanent encryption key is generated for each user.
4. Passwords are generated according to selected parameters.
5. Passwords are encrypted before being stored.
6. Users can view and manage saved password records.

**UML and Database Design**

The project includes:

UML Class Diagram
Entity Relationship (ER) Diagram

**Author**

Bilawal Afzal
