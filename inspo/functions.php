<?php
session_start();

// Database connection
$db = new mysqli('localhost', 'username', 'password', 'huanfitnesspal_db');

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

function register($name, $email, $password) {
    global $db;
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $db->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $hashed_password);
    return $stmt->execute();
}

function login($email, $password) {
    global $db;
    $stmt = $db->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($user = $result->fetch_assoc()) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            return true;
        }
    }
    return false;
}

function logWeight($user_id, $weight) {
    global $db;
    $stmt = $db->prepare("INSERT INTO weight_logs (user_id, weight) VALUES (?, ?)");
    $stmt->bind_param("id", $user_id, $weight);
    return $stmt->execute();
}

function logExercise($user_id, $exercise_type, $duration) {
    global $db;
    $stmt = $db->prepare("INSERT INTO exercise_logs (user_id, exercise_type, duration) VALUES (?, ?, ?)");
    $stmt->bind_param("isi", $user_id, $exercise_type, $duration);
    return $stmt->execute();
}

function logWater($user_id, $amount) {
    global $db;
    $stmt = $db->prepare("INSERT INTO water_logs (user_id, amount) VALUES (?, ?)");
    $stmt->bind_param("id", $user_id, $amount);
    return $stmt->execute();
}

function requestNutritionistConsultation($user_id, $date, $time) {
    global $db;
    $stmt = $db->prepare("INSERT INTO nutritionist_requests (user_id, request_date, request_time) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $date, $time);
    return $stmt->execute();
}

// Add more functions as needed for data retrieval and management

?>
