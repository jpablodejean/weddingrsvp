<!-- admin.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel - Create new wedding</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <main>
        <form action="admin_process.php" method="POST">
            <label for="couple_name">Nombre de la pareja:</label>
            <input type="text" id="couple_name" name="couple_name" required><br><br>

            <label for="wedding_date">Fecha de la boda (dd/mm/yyyy):</label>
            <input type="text" id="wedding_date" name="wedding_date" placeholder="dd/mm/yyyy" required><br><br>

            <label for="location">Ubicación (Coordenadas) :</label>
            <input type="text" id="location" name="location" required><br><br>

            <label for="other_details"> Otros datos:</label><br>
            <textarea id="other_details" name="other_details" rows="4" cols="50"></textarea><br><br>

            <input type="submit" value="Crear boda">
        </form>
        <a href="list_weddings.php">Listado de bodas</a>
    </main>
    <footer>
        <p>&copy; 2024 Badablü</p>
    </footer>
</body>
</html>
