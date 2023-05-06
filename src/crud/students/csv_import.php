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

        // Prepare the SQL statements for inserting and updating records
        $insert_stmt = $conn->prepare("INSERT INTO tb_students (email, firstname, lastname, section) VALUES (?, ?, ?, ?)");
        $update_stmt = $conn->prepare("UPDATE tb_students SET firstname = ?, lastname = ?, section = ? WHERE email = ?");

        while (($data = fgetcsv($file, 1000, ',')) !== false) {
            // Skip the first row (header row)
            if ($data[0] == 'email') {
                continue;
            }

            $email = $data[0];
            $firstname = $data[1];
            $lastname = $data[2];
            $section = $data[3];

            // Check if the email already exists in the database
            $check_stmt = $conn->prepare("SELECT * FROM tb_students WHERE email = ?");
            $check_stmt->bindParam(1, $email);
            $check_stmt->execute();
            $existing_record = $check_stmt->fetch();

            if ($existing_record) {
                // If the email exists, update the existing record
                $update_stmt->bindParam(1, $firstname);
                $update_stmt->bindParam(2, $lastname);
                $update_stmt->bindParam(3, $section);
                $update_stmt->bindParam(4, $email);

                if (!$update_stmt->execute()) {
                    echo "error_upload";
                    exit();
                }
            } else {
                // If the email doesn't exist, insert a new record
                $insert_stmt->bindParam(1, $email);
                $insert_stmt->bindParam(2, $firstname);
                $insert_stmt->bindParam(3, $lastname);
                $insert_stmt->bindParam(4, $section);

                if (!$insert_stmt->execute()) {
                    echo "error_upload";
                    exit();
                }
            }
        }

        $insert_stmt = null;
        $update_stmt = null;
        $check_stmt = null;
        $conn = null;

        echo "success";
    } else {
        echo "error_file_not_set";
        error_log(print_r($_FILES, true));
    }
}
