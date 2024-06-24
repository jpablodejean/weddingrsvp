<?php
// update_wedding.php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the posted data
    $wedding_id = $_POST['wedding_id'];
    $couple_name = $_POST['couple_name'];
    $wedding_date = $_POST['wedding_date'];
    $location = $_POST['location'];
    $other_details = $_POST['other_details'];

    // Convert the wedding date to the correct format for the database
    $date_parts = explode("/", $wedding_date);
    if (count($date_parts) == 3) {
        $wedding_date_formatted = $date_parts[2] . '-' . $date_parts[1] . '-' . $date_parts[0];
    } else {
        $wedding_date_formatted = $wedding_date; // fallback in case of unexpected format
    }

    // Update the wedding details in the database
    $sql = "UPDATE weddings SET couple_name='$couple_name', wedding_date='$wedding_date_formatted', location='$location', other_wedding_details='$other_details' WHERE wedding_id=$wedding_id";

    if (mysqli_query($conn, $sql)) {
        header("Location: list_weddings.php?status=success");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    echo "Invalid request";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Wedding</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Update Wedding</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="list_weddings.php">Back to Wedding List</a></li>
        </ul>
    </nav>
    <main>
        <!-- Display any success or error messages here if needed -->
    </main>
    <footer>
        <p>&copy; 2024 Your Wedding Site</p>
    </footer>
</body>
</html>
