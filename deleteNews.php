<?php
$link = mysqli_connect("localhost", "root", "12345*678", "news_portal");

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $news_id = $_POST['news_id'] ?? '';

    if(empty($news_id)){
        die("Error: News ID missing. Operation aborted.");
    }

    // Prepare statement to avoid SQL injection
    $stmt = mysqli_prepare($link, "DELETE FROM news WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $news_id);

    if(mysqli_stmt_execute($stmt)){
        echo "News deleted successfully!";
    } else {
        echo "Delete failed: " . mysqli_error($link);
    }

    mysqli_stmt_close($stmt);
} else {
    die("Invalid request.");
}

mysqli_close($link);
?>
