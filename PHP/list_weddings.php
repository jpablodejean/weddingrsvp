<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Weddings</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* General button styles */
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            margin-right: 10px; /* Add some spacing between buttons */
            margin-bottom: 10px; /* Add spacing below buttons */
            cursor: pointer; /* Change cursor to pointer */
            font-family: inherit; /* Inherit font from parent element */
            font-size: inherit; /* Inherit font size from parent element */
        }

        .button:hover {
            background-color: #555; /* Darken the background color on hover */
        }

        /* Styling for each wedding entry */
        .wedding {
            border: 1px solid #ced4da;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 10px;
            background: #f8f9fa;
        }

        .wedding p {
            margin: 5px 0;
        }

        /* Container for buttons to keep them aligned */
        .button-container {
            display: flex;
            flex-wrap: wrap;
            align-items: center; /* Center align items */
        }

        /* Styling the delete button to look like the anchor buttons */
        .delete-form {
            margin: 0; /* Remove default margin */
            display: inline-block; /* Align inline with other buttons */
        }

        .delete-form button {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none; /* Remove underline */
            display: inline-block; /* Ensure button behaves like a link */
            font-family: inherit; /* Inherit font from parent element */
            font-size: inherit; /* Inherit font size from parent element */
        }

        .delete-form button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <header>

    </header>
    <nav>
        <ul>
            <li><a href="admin.php">Crear nueva boda</a></li>
        </ul>
    </nav>
    <main>

    <?php
    // Include the database connection file
    include 'db_connection.php';

    // Check if the delete request is sent
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_wedding']) && isset($_POST['wedding_id'])) {
        $wedding_id = $_POST['wedding_id'];
        // SQL query to delete the wedding
        $delete_sql = "DELETE FROM weddings WHERE wedding_id = $wedding_id";
        if (mysqli_query($conn, $delete_sql)) {
            echo "<p>Wedding deleted successfully!</p>";
        } else {
            echo "<p>Error deleting wedding: " . mysqli_error($conn) . "</p>";
        }
    }

    // SQL query to retrieve all weddings
    $sql = "SELECT * FROM weddings";
    $result = mysqli_query($conn, $sql);

    // Check if there are any weddings
    if (mysqli_num_rows($result) > 0) {
        // Output data of each wedding
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='wedding'>";
            echo "<p><strong>Wedding ID:</strong> " . $row["wedding_id"] . "</p>";
            echo "<p><strong>Couple's Name:</strong> " . $row["couple_name"] . "</p>";
            echo "<p><strong>Wedding Date:</strong> " . $row["wedding_date"] . "</p>";
            echo "<p><strong>Location:</strong> " . $row["location"] . "</p>"; // Display location
            echo "<p><strong>Other Details:</strong> " . $row["other_wedding_details"] . "</p>";
            echo "<div class='button-container'>";
            // Add links styled as buttons
            echo "<a class='button' href='invitee.php?wedding_id=" . $row["wedding_id"] . "' target='_blank'>RSVP for this Wedding</a>";
            echo "<a class='button' href='edit_wedding.php?wedding_id=" . $row["wedding_id"] . "' target='_blank'>Edit Wedding</a>";
            echo "<a class='button' href='view_rsvps.php?wedding_id=" . $row["wedding_id"] . "' target='_blank'>View RSVPs and Messages</a>";
            // Add a form with a delete button styled as an anchor button
            echo "<form action='list_weddings.php' method='POST' class='delete-form'>";
            echo "<input type='hidden' name='wedding_id' value='" . $row["wedding_id"] . "'>";
            echo "<button type='submit' name='delete_wedding' value='delete_wedding' class='button'>Delete Wedding</button>";
            echo "</form>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "No weddings found";
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
    </main>
    <footer>
        <p>&copy; 2024 Your Wedding Site</p>
    </footer>
</body>
</html>
