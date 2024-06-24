<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $couple_name = mysqli_real_escape_string($conn, $_POST['couple_name']);
    $wedding_date = mysqli_real_escape_string($conn, $_POST['wedding_date']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $other_details = mysqli_real_escape_string($conn, $_POST['other_details']);

    $sql = "INSERT INTO weddings (couple_name, wedding_date, location, other_wedding_details) 
            VALUES ('$couple_name', STR_TO_DATE('$wedding_date', '%d/%m/%Y'), '$location', '$other_details')";

    if (mysqli_query($conn, $sql)) {
        header("Location: admin.php?status=success");
        echo "<a href='list_weddings.php'>View all weddings</a>"; // Add the link button here
        exit();
    } else {
        header("Location: admin.php?status=error");
        exit();
    }
}

mysqli_close($conn);
?>
