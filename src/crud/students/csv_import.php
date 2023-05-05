<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_FILES['file'])) {
        // Check if file is a CSV file
        $filetype = $_FILES['file']['type'];
        if ($filetype != 'text/csv' && $filetype != 'application/vnd.ms-excel') {
            echo "unsupported_file";
            exit();
        }

        // Open and read the CSV file
        $file = fopen($_FILES['file']['tmp_name'], 'r');
        if ($file === false) {
            echo "error_reading_file";
            exit();
        }

        // Check if file has the expected format
        $expected_header = ['Email', 'First Name', 'Last Name', 'Section'];
        $header = fgetcsv($file, 1000, ',');

        if ($header !== $expected_header) {
            echo "invalid_format";
            exit();
        }

        // Get the database connection
        require "../../../config/connection.php";

        // Insert the data into the tb_students table
        $stmt = $conn->prepare("INSERT INTO tb_students (email, firstname, lastname, section) VALUES (?, ?, ?, ?)");

        while (($data = fgetcsv($file, 1000, ',')) !== false) {
            // Skip the first row (header row)
            if ($data[0] == 'email') {
                continue;
            }

            $email = $data[0];
            $firstname = $data[1];
            $lastname = $data[2];
            $section = $data[3];

            $stmt->bindParam(1, $email);
            $stmt->bindParam(2, $firstname);
            $stmt->bindParam(3, $lastname);
            $stmt->bindParam(4, $section);

            if (!$stmt->execute()) {
                echo "error_upload";
                exit();
            }
        }

        $stmt = null;
        $conn = null;

        echo "success";
    } else {
        echo "error_file_not_set";
        error_log(print_r($_FILES, true));
    }
}
