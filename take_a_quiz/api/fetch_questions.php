<!-- filepath: c:\Users\rjena\OneDrive\Desktop\Project\Quizzet-website\take_a_quiz\api\fetch_questions.php -->
<?php
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');
include '/take_a_quiz/config.php';


try {
    // Step 1: Fetch questions from an external API
    $externalApiUrl = 'https://opentdb.com/api.php?amount=10&type=multiple';
    $externalResponse = file_get_contents($externalApiUrl);
    $externalQuestions = json_decode($externalResponse, true);

    if (isset($externalQuestions['response_code']) && $externalQuestions['response_code'] === 0) {
        $questions = [];
        foreach ($externalQuestions['results'] as $question) {
            $questions[] = [
                'question' => $question['question'],
                'options' => array_merge($question['incorrect_answers'], [$question['correct_answer']]),
                'correct_option' => $question['correct_answer']
            ];
        }
        echo json_encode(['status' => 'success', 'questions' => $questions]);
        exit;
    } else {
        throw new Exception('Failed to fetch questions from the external API.');
    }
} catch (Exception $e) {
    // Step 2: Fallback to fetching questions from the local database
    try {
        $questions = fetchQuestions($conn, 10); // Fetch 10 questions from the database

        if (!empty($questions)) {
            // Return questions fetched from the local database
            echo json_encode(['status' => 'success', 'questions' => $questions]);
        } else {
            throw new Exception('No questions found in the local database.');
        }
    } catch (Exception $dbException) {
        // Handle any errors during database fetch
        echo json_encode(['status' => 'error', 'message' => $dbException->getMessage()]);
    }
}
?>