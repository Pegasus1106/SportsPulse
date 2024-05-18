<?php
include_once "db_connection.php";

// Function to display a warning message popup
function displayWarningMessage($message) {
    echo "<script>alert('$message');</script>";
}

// Check if article ID is provided in the URL
if (isset($_GET['id'])) {
    $article_id = $_GET['id'];

    // Delete the article from the database
    $sql = "DELETE FROM newss WHERE id = $article_id";

    if ($conn->query($sql) === TRUE) {
        // Redirect to index.html
        echo "<script>window.location.href = 'index.html';</script>";
        exit; // Exit to prevent further execution of the script
    } else {
        // Display warning message popup for unsuccessful deletion
        displayWarningMessage("Delete unsuccessful. Please try again.");
    }
} else {
    // Display warning message popup for missing article ID
    displayWarningMessage("Article ID not provided");
}

$conn->close();
?>

