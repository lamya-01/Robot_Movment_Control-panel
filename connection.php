<?php
    // Database configuration
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "robotmovement";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_POST['command'])) {
        $command = $_POST['command'];

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO direction (robotDirection) VALUES (?)");
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("s", $command);

        if ($stmt->execute()) {
            $message = "Command saved successfully";
        } else {
            $message = "Execute failed: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $message = "Command not provided";
    }

    $conn->close();
?>