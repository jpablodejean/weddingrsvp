<?php
// Include the database connection file
include 'db_connection.php';

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $wedding_id = mysqli_real_escape_string($conn, $_POST['wedding_id']);
    $guest_name = mysqli_real_escape_string($conn, $_POST['guest_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $rsvp_confirmation = mysqli_real_escape_string($conn, $_POST['rsvp_confirmation']);
    $food_preferences = mysqli_real_escape_string($conn, $_POST['food_preferences']);
    $message_to_couple = mysqli_real_escape_string($conn, $_POST['message_to_couple']);

    // SQL query to insert RSVP data into the database
    $sql = "INSERT INTO rsvp_messages (wedding_id, guest_name, email, rsvp_confirmation, food_preferences, message_to_couple) 
            VALUES ('$wedding_id', '$guest_name', '$email', '$rsvp_confirmation', '$food_preferences', '$message_to_couple')";

    // Execute the SQL query
    if (mysqli_query($conn, $sql)) {
        // Send a message indicating successful submission
        echo "RSVP submitted successfully";

        // Close the database connection
        mysqli_close($conn);
        exit(); // Terminate script execution
    } else {
        // Send an error message if submission fails
        echo "Error submitting RSVP: " . mysqli_error($conn);
    }
}
?>
