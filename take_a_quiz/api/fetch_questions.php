<!-- filepath: c:\Users\rjena\OneDrive\Desktop\Project\Quizzet-website\take_a_quiz\api\fetch_questions.php -->
<?php
header('Content-Type: application/json');
include '../config.php'; // Include the database configuration

try {
    // Fetch questions using the helper function
    $questions = fetchQuestions($conn, 10); // Fetch 10 questions

    // Return the questions as a JSON response
    echo json_encode(['status' => 'success', 'questions' => $questions]);
} catch (Exception $e) {
    // Handle any errors
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>