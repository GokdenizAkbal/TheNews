<?php
header('Content-Type: application/json; charset=UTF-8');
require 'databaseConnection.php';

if (!isset($_GET['id'])) {
    echo json_encode(['error' => 'No ID provided']);
    exit;
}

$news_id = intval($_GET['id']);

// Get news data
$stmt = mysqli_prepare($link, "SELECT * FROM news WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $news_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$news = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if (!$news) {
    echo json_encode(['error' => 'Unvalid ID or could not find.']);
    exit;
}

// Return data as JSON
echo json_encode([
    'id' => $news['id'],
    'title' => $news['title'],
    'description' => $news['description'],
    'author' => $news['author'],
    'publish_date' => $news['publish_date'],
    'card_type' => $news['card_type'],
    'tags' => $news['tags'],
    'category' => $news['category'],
    'image_path' => $news['image_path']
]);

$link->close();
?>
