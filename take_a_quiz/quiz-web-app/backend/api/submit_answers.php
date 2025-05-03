<?php
include '../db/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userAnswers = json_decode(file_get_contents('php://input'), true);
    $score = 0;

    // Fetch correct answers from the database
    $query = "SELECT question_id, correct_answer FROM questions WHERE question_id IN (" . implode(',', array_keys($userAnswers)) . ")";
    $result = $conn->query($query);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $questionId = $row['question_id'];
            $correctAnswer = $row['correct_answer'];

            if (isset($userAnswers[$questionId]) && $userAnswers[$questionId] === $correctAnswer) {
                $score++;
            }
        }
    }

    $totalQuestions = count($userAnswers);
    $response = [
        'score' => $score,
        'total' => $totalQuestions,
        'percentage' => ($score / $totalQuestions) * 100
    ];

    echo json_encode($response);
} else {
    http_response_code(405);
    echo json_encode(['message' => 'Method not allowed']);
}
?>