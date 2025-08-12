<?php

$link = mysqli_connect("localhost", "root", "12345*678", "news_portal");

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
// Attempt create table query execution
$sql = "CREATE TABLE news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,       
    description TEXT NOT NULL,         
    image_path VARCHAR(255) NOT NULL,  
    author VARCHAR(100) NOT NULL,      
    publish_date DATE NOT NULL,        
    card_type ENUM('large','small') NOT NULL DEFAULT 'small', 
    tags VARCHAR(255)                  
)";

if(mysqli_query($link, $sql)){
    echo "Table created successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
// Close connection
mysqli_close($link);
?>