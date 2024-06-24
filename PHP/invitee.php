<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RSVP Form</title>
    <link rel="stylesheet" href="styles.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap">

    <style>
        body {
            font-family: 'Georgia', serif;
            background: transparent;
            color: #343a40;
            margin: 0;
            padding: 0;
        }

        main {
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
            background: transparent;
        }

        .wedding-details {
            margin-bottom: 20px;
        }

        .wedding-details h2 {
            font-family: 'Cinzel', serif;
            color: #6c757d;
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }

        .wedding-details p {
            margin: 5px 0;
            font-size: 1.1em;
        }

        form {
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        form label {
            display: block;
            margin: 10px 0 5px;
        }

        form input[type="text"],
        form input[type="email"],
        form select,
        form textarea {
            width: 90%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            font-size: 1em;
        }

        input[type="submit"] {
            background-color: #0f5132;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0c3e26;
        }

        a {
            color: #0f5132;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <main>
        <?php
        if (isset($_GET['wedding_id'])) {
            $wedding_id = $_GET['wedding_id'];
            include 'db_connection.php';
            $sql = "SELECT * FROM weddings WHERE wedding_id = $wedding_id";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $wedding_date_formatted = date('d/m/Y', strtotime($row["wedding_date"]));
                $latitude_longitude = explode(",", $row["location"]);
                $latitude = trim($latitude_longitude[0]);
                $longitude = trim($latitude_longitude[1]);
        ?>
<!--     <div class="wedding-details">
            <h2><?php echo $row["couple_name"]; ?></h2>
            <p><strong>Wedding Date:</strong> <?php echo $wedding_date_formatted; ?></p>
            <p><strong>Location:</strong> <a href="https://www.google.com/maps/dir/?api=1&destination=<?php echo $latitude; ?>,<?php echo $longitude; ?>">View on Google Maps</a></p>
            <p><strong>Other Details:</strong> <?php echo $row["other_wedding_details"]; ?></p>
        </div>
		
-->
        <?php
            } else {
                echo "<p style='color:red;'>Wedding not found</p>";
            }
            mysqli_close($conn);
        } else {
            echo "<p style='color:red;'>Invalid request</p>";
        }
        ?>
        <h2>RSVP</h2>
        <form action="submit_rsvp.php" method="POST">
            <input type="hidden" name="wedding_id" value="<?php echo $wedding_id; ?>">
            <label for="guest_name">Su nombre:</label>
            <input type="text" id="guest_name" name="guest_name" required>

            <label for="email">Su Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="rsvp_confirmation">Confirmo asistencia:</label>
            <select id="rsvp_confirmation" name="rsvp_confirmation" required>
                <option value="">Seleccione</option>
                <option value="Yes">Sí, atenderé</option>
                <option value="No">No, lamentablemente no podré asistir</option>
            </select>

            <label for="food_preferences">Preferencias gastronómicas:</label>
            <textarea id="food_preferences" name="food_preferences" rows="4"></textarea>

            <label for="message_to_couple">Mensaje para la pareja:</label>
            <textarea id="message_to_couple" name="message_to_couple" rows="4"></textarea>

            <input type="submit" value="Enviar RSVP">
        </form>
    </main>
</body>
</html>
