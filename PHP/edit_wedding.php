<!-- edit_wedding.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Wedding</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Edit Wedding</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
        </ul>
    </nav>
    <main>
        <?php
        // Include the database connection file
        include 'db_connection.php';

        // Check if wedding_id parameter is set in the URL
        if (isset($_GET['wedding_id'])) {
            $wedding_id = $_GET['wedding_id'];

            // Retrieve wedding details from the database
            $sql = "SELECT * FROM weddings WHERE wedding_id = $wedding_id";
            $result = mysqli_query($conn, $sql);

            // Check if the wedding exists
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                // Format the wedding date to day/month/year format
                $wedding_date_formatted = date('d/m/Y', strtotime($row["wedding_date"]));
                ?>
                <form action="update_wedding.php" method="POST">
                    <input type="hidden" name="wedding_id" value="<?php echo $wedding_id; ?>">
                    <label for="couple_name">Couple's Name:</label>
                    <input type="text" id="couple_name" name="couple_name" value="<?php echo $row['couple_name']; ?>" required><br><br>

                    <label for="wedding_date">Wedding Date (dd/mm/yyyy):</label>
                    <input type="text" id="wedding_date" name="wedding_date" value="<?php echo $wedding_date_formatted; ?>" placeholder="dd/mm/yyyy" required><br><br>

                    <label for="location">Location:</label>
                    <input type="text" id="location" name="location" value="<?php echo $row['location']; ?>" required><br><br>

                    <label for="other_details">Other Details:</label><br>
                    <textarea id="other_details" name="other_details" rows="4" cols="50"><?php echo $row['other_wedding_details']; ?></textarea><br><br>

                    <input type="submit" value="Update Wedding">
                </form>
                <?php
            } else {
                echo "Wedding not found";
            }

            // Close the database connection
            mysqli_close($conn);
        } else {
            echo "Invalid request";
        }
        ?>
    </main>
    <footer>
        <p>&copy; 2024 Your Wedding Site</p>
    </footer>
</body>
</html>
