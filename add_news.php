<?php
// Include your database connection file
include_once "db_connection.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $brief = $_POST["brief"];
    $description=$_POST["description"];
    // Handle image upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    
    // Insert data into MySQL table
    $sql = "INSERT INTO newss (title, brief, description,image) VALUES ('$title', '$brief','$description','$target_file')";
    
    if ($conn->query($sql) === TRUE) {
        // Redirect to index.html
        echo "<script>window.location.href = 'index.html';</script>";
        exit; // Exit to prevent further execution of the script
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
}
?>
