<?php
// Database configuration
$host = 'localhost'; // Database host
$dbname = 'quizzet'; // Database name
$username = 'root'; // Database username
$password = 'Rohit@1075'; // Database password

// Create a connection to the database
$conn = new mysqli($host, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Set the character set to UTF-8 (important for special characters in questions/answers)
$conn->set_charset("utf8");

// Helper function to fetch questions
function fetchQuestions($conn, $limit = 10) {
    $sql = "SELECT id, question, options, correct_option FROM quiz_questions LIMIT ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $limit);
    $stmt->execute();
    $result = $stmt->get_result();

    $questions = [];
    while ($row = $result->fetch_assoc()) {
        $questions[] = [
            'id' => $row['id'],
            'question' => $row['question'],
            'options' => json_decode($row['options'], true), // Decode JSON options
            'correct_option' => $row['correct_option']
        ];
    }

    $stmt->close();
    return $questions;
}

// Helper function to insert quiz results
function insertQuizResult($conn, $username, $score) {
    $sql = "INSERT INTO quiz_results (username, score) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $username, $score);

    if ($stmt->execute()) {
?>}    }        return false;    } else {        return true;        return true;
    } else {
        return false;
    }
}
?>