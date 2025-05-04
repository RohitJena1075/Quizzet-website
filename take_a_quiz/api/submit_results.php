<!-- filepath: c:\Users\rjena\OneDrive\Desktop\Project\Quizzet-website\take_a_quiz\api\submit_results.php -->
<?php
header('Content-Type: application/json');
include '/take_a_quiz/config.php'; // Include the database configuration

function insertQuizResult($conn, $username, $score) {
    $stmt = $conn->prepare("INSERT INTO quiz_results (username, score) VALUES (?, ?)");
    $stmt->bind_param("si", $username, $score);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted data
    $data = json_decode(file_get_contents('php://input'), true);

    $username = $data['username'] ?? 'Anonymous'; // Default to 'Anonymous' if no username is provided
    $score = $data['score'] ?? 0; // Default to 0 if no score is provided

    // Insert the result using the helper function
    if (insertQuizResult($conn, $username, $score)) {
        echo json_encode(['status' => 'success', 'message' => 'Results submitted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to submit results.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}

$conn->close();
?>