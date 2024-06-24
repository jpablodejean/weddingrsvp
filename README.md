# Wedding RSVP System

## Overview

This project is a web-based system for managing wedding RSVPs. It includes functionality for creating and listing weddings, inviting guests, and managing RSVPs. The project consists of several PHP scripts for handling various tasks, such as creating weddings, submitting RSVPs, and listing wedding details.

## Project Structure

- `admin.php`: The admin interface for creating new weddings.
- `list_weddings.php`: A page to list all weddings with options to edit or delete each wedding.
- `invitee.php`: The RSVP form for guests to submit their details.
- `submit_rsvp.php`: The script that processes RSVP submissions.
- `db_connection.php`: Contains the database connection settings.
- `styles.css`: The stylesheet for styling the web pages.

## Requirements

- PHP 7.0 or higher
- MySQL database
- Web server (e.g., Apache)

## Setup

1. **Clone the repository:**

    ```bash
    git clone https://github.com/jpablodejean/weddingrsvp.git
    ```

2. **Create the database:**

    - Create a MySQL database named `wedding_rsvp`.
    - Import the provided `wedding_rsvp.sql` file to create the necessary tables.

3. **Configure database connection:**

    - Update the `db_connection.php` file with your database credentials.

    ```php
    <?php
    $servername = "your_server_name";
    $username = "your_username";
    $password = "your_password";
    $dbname = "wedding_rsvp";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    ?>
    ```

4. **Deploy the project:**

    - Upload the project files to your web server.
    - Ensure the server is configured to run PHP files.

## Usage

### Admin Interface

1. **Create a new wedding:**

    - Navigate to `admin.php`.
    - Fill out the form with the wedding details and click "Create Wedding".

2. **View and manage weddings:**

    - Navigate to `list_weddings.php`.
    - Here you can see a list of all weddings, with options to edit or delete each wedding.

### Guest RSVP

1. **RSVP for a wedding:**

    - Guests should be provided with a link to the `invitee.php` page, including the wedding ID as a query parameter (e.g., `invitee.php?wedding_id=1`).
    - Guests fill out the RSVP form and submit their details.

2. **Confirmation:**

    - Upon successful submission, guests will see a confirmation message.
    - The system also sends a message to the parent window for integration with Construct 3.



## Notes

- Ensure your server has the necessary permissions to access the database.
- Modify the CSS in `styles.css` to customize the appearance of the pages.

## Troubleshooting

- If you encounter issues with database connections, double-check your credentials and database configuration.
- Ensure all necessary PHP extensions are installed and enabled on your server.
- Use browser developer tools to debug and inspect any JavaScript errors or issues with form submissions.




