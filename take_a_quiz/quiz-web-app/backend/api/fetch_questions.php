<?php
header('Content-Type: application/json');

include_once '../db/connection.php';

$category = isset($_GET['category']) ? $_GET['category'] : 'general';

try {
    $stmt = $conn->prepare("SELECT * FROM questions WHERE category = :category");
    $stmt->bindParam(':category', $category);
    $stmt->execute();

    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($questions) {
        echo json_encode(['status' => 'success', 'data' => $questions]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No questions found for this category.']);
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
}
?>