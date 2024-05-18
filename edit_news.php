<?php
include_once "db_connection.php";

// Function to display a warning message popup
function displayWarningMessage($message) {
    echo "<script>alert('$message');</script>";
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if article_id is provided
    if (isset($_POST["article_id"])) {
        $article_id = $_POST["article_id"];
        
        // Fetch article details based on ID from database
        $sql = "SELECT * FROM newss WHERE id = $article_id";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            
            // Retrieve form data
            $title = $_POST["title"];
            $brief = $_POST["brief"]; // Add this line to retrieve the brief data
            $description = $_POST["description"];
            
            // Handle image upload if provided
            if ($_FILES["image"]["size"] > 0) {
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                
                // Update image path in database
                $sql = "UPDATE newss SET image='$target_file' WHERE id=$article_id";
                $conn->query($sql);
            }
            
            // Update title, brief, and description in database
            $sql = "UPDATE newss SET title='$title', brief='$brief', description='$description' WHERE id=$article_id"; // Update this line
            
            if ($conn->query($sql) === TRUE) {
                // Redirect to the home page
                echo "<script>window.location.href = 'index.html';</script>";
                exit; // Exit to prevent further execution of the script
            } else {
                // Display warning message popup for unsuccessful update
                displayWarningMessage("Update unsuccessful. Please try again.");
            }
        } else {
            // Display warning message popup for article not found
            displayWarningMessage("Article not found.");
        }
    } else {
        // Display warning message popup for missing article ID
        displayWarningMessage("Article ID not provided.");
    }
} else {
    // Display warning message popup for invalid request
    displayWarningMessage("Invalid request.");
}

$conn->close();
?>
