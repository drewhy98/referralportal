<?php
// Only start session if it hasn't started yet
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* ---------- DATABASE CONNECTION ---------- */
$host = "localhost";
$dbname = "referral_db";   // DB name
$username = "root";        // DB username
$password = "";            // DB password

//create connection PDO used 

try {
    $db = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );

    //check connection
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
