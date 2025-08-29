<?php
require 'databaseConnection.php'; // Database connection

// Get form data
$title = $_POST['title'];
$description = $_POST['description'];
$author = $_POST['author'];
$publish_date = $_POST['publish_date'];
$card_type = $_POST['card_type'];
$tags = $_POST['tags'];
$category = $_POST['category'];

// Upload file
$image_path = '';
if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
    $targetDir = "uploads/";
    $uniqueName = uniqid() . '_' . basename($_FILES['image']['name']); // Avoid file name conflict
    $targetFile = $targetDir . $uniqueName;
    if(move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)){
        $image_path = $targetFile;
    } else {
        echo "Error uploading image.";
        exit;
    }
}

// SQL query
$sql = "INSERT INTO news (title, description, image_path, author, publish_date, card_type, tags, category) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

// Prepared statement (procedural style)
$stmt = mysqli_prepare($link, $sql);
if(!$stmt){
    die("Prepare failed: " . mysqli_error($link));
}

// Parameters connection
mysqli_stmt_bind_param($stmt, "ssssssss", $title, $description, $image_path, $author, $publish_date, $card_type, $tags, $category);

// Execute
if(mysqli_stmt_execute($stmt)){
    echo "News added successfully!";
} else {
    echo "Error: " . mysqli_stmt_error($stmt);
}

// Close connection and statement
mysqli_stmt_close($stmt);
mysqli_close($link);
?>
