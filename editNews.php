<?php
require 'databaseConnection.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Form Data
    $news_id = $_POST['news_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $author = $_POST['author'];
    $publish_date = $_POST['publish_date'];
    $card_type = $_POST['card_type'];
    $tags = $_POST['tags'];
    $category = $_POST['category'];

    // Upload Image
    $image_path = '';
    if(isset($_FILES['image']) && $_FILES['image']['error'] === 0){
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }
        $uniqueName = uniqid() . '_' . basename($_FILES['image']['name']);
        $targetFile = $targetDir . $uniqueName;
        if(move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)){
            $image_path = $targetFile;
        } else {
            echo "<script>alert('Error uploading image.'); window.history.back();</script>";
            exit;
        }
    }

    // Updates Areas
    $updateFields = [];
    $params = [];
    $types = '';

    if(!empty($title)){
        $updateFields[] = "title = ?";
        $params[] = $title;
        $types .= 's';
    }
    if(!empty($description)){
        $updateFields[] = "description = ?";
        $params[] = $description;
        $types .= 's';
    }
    if(!empty($author)){
        $updateFields[] = "author = ?";
        $params[] = $author;
        $types .= 's';
    }
    if(!empty($publish_date)){
        $updateFields[] = "publish_date = ?";
        $params[] = $publish_date;
        $types .= 's';
    }
    if(!empty($card_type)){
        $updateFields[] = "card_type = ?";
        $params[] = $card_type;
        $types .= 's';
    }
    if(!empty($tags)){
        $updateFields[] = "tags = ?";
        $params[] = $tags;
        $types .= 's';
    }
    if(!empty($category)){
        $updateFields[] = "category = ?";
        $params[] = $category;
        $types .= 's';
    }
    if(!empty($image_path)){
        $updateFields[] = "image_path = ?";
        $params[] = $image_path;
        $types .= 's';
    }

    if(!empty($updateFields)){
        $sql = "UPDATE news SET " . implode(", ", $updateFields) . " WHERE id = ?";
        $params[] = $news_id;
        $types .= 'i';

        $stmt = mysqli_prepare($link, $sql);
        if(!$stmt){
            die("Prepare failed: " . mysqli_error($link));
        }

        mysqli_stmt_bind_param($stmt, $types, ...$params);

        if(mysqli_stmt_execute($stmt)){
            echo "News updated successfully!";
        } else {
            echo "Update failed: ". mysqli_stmt_error($stmt);
        }


        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('No fields to update.'); window.history.back();</script>";
    }

    mysqli_close($link);

} else {
    echo "<script>alert('Invalid request.'); window.history.back();</script>";
}
?>
