<!-- view_rsvps.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View RSVPs and Messages</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .rsvp {
            border: 1px solid #ced4da;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 10px;
            background: #f8f9fa;
        }
        .rsvp p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <header>

    </header>
    <nav>
        <ul>

        </ul>
    </nav>
    <main>
        <h2>RSVPs and Messages for Wedding:</h2>
        <?php
        // Check if wedding_id parameter is set in the URL
        if (isset($_GET['wedding_id'])) {
            // Include the database connection file
            include 'db_connection.php';

            // Retrieve wedding_id from the URL
            $wedding_id = $_GET['wedding_id'];

            // SQL query to retrieve RSVPs and messages for the selected wedding
            $sql = "SELECT * FROM rsvp_messages WHERE wedding_id = $wedding_id";
            $result = mysqli_query($conn, $sql);

            // Check if there are any RSVPs and messages
            if (mysqli_num_rows($result) > 0) {
                // Output data of each RSVP and message
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='rsvp'>";
                    echo "<p><strong>Guest Name:</strong> " . $row["guest_name"] . "</p>";
                    echo "<p><strong>Email:</strong> " . $row["email"] . "</p>";
                    echo "<p><strong>RSVP Confirmation:</strong> " . $row["rsvp_confirmation"] . "</p>";
                    echo "<p><strong>Food Preferences:</strong> " . $row["food_preferences"] . "</p>";
                    echo "<p><strong>Message to Couple:</strong> " . $row["message_to_couple"] . "</p>";
                    echo "</div>";
                }
            } else {
                echo "No RSVPs and messages found for this wedding";
            }

            // Close the database connection
            mysqli_close($conn);
        } else {
            echo "Invalid request";
        }
        ?>
        <form action="export_rsvps.php" method="post">
            <input type="hidden" name="wedding_id" value="<?php echo $wedding_id; ?>">
            <button type="submit">Export to CSV</button>
        </form>
    </main>
    
</body>
</html>
