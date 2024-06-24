<?php
// export_rsvps.php

// Include the database connection file
include 'db_connection.php';

// Check if wedding_id parameter is set in the POST request
if (isset($_POST['wedding_id'])) {
    // Retrieve wedding_id from the POST data
    $wedding_id = $_POST['wedding_id'];

    // SQL query to retrieve RSVPs and messages for the selected wedding
    $sql = "SELECT * FROM rsvp_messages WHERE wedding_id = $wedding_id";
    $result = mysqli_query($conn, $sql);

    // Check if there are any RSVPs and messages
    if (mysqli_num_rows($result) > 0) {
        // Set headers for file download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="rsvp.csv"');
        header('Pragma: no-cache');
        header('Expires: 0');

        // Output the CSV header
        echo "Guest Name,Email,RSVP Confirmation,Food Preferences,Message to Couple\n";

        // Output data of each RSVP and message
        while ($row = mysqli_fetch_assoc($result)) {
            echo '"' . $row["guest_name"] . '","' . $row["email"] . '","' . $row["rsvp_confirmation"] . '","' . $row["food_preferences"] . '","' . $row["message_to_couple"] . "\"\n";
        }

        // Close the database connection
        mysqli_close($conn);
        exit; // Terminate the script after generating the file
    } else {
        echo "No RSVPs and messages found for this wedding";
    }
} else {
    echo "Invalid request";
}
?>
