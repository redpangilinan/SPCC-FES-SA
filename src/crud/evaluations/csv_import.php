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
        $expected_header = ['Faculty Name', 'Subject', 'School Year', 'Semester', 'Permit'];
        $header = fgetcsv($file, 1000, ',');

        if ($header !== $expected_header) {
            echo "invalid_format";
            exit();
        }

        // Get the database connection
        require "../../../config/connection.php";

        // Insert the data into the tb_students table
        $stmt = $conn->prepare("INSERT INTO tb_evaluations (faculty_name, subject, school_year, semester, access_code, permit) VALUES (?, ?, ?, ?, ?, ?)");

        while (($data = fgetcsv($file, 1000, ',')) !== false) {
            // Skip the first row (header row)
            if ($data[0] == 'email') {
                continue;
            }

            $faculty_name = $data[0];
            $subject = $data[1];
            $school_year = $data[2];
            $semester = $data[3];
            $permit = $data[4];
            $access_code = bin2hex(random_bytes(6));

            $stmt->bindParam(1, $faculty_name);
            $stmt->bindParam(2, $subject);
            $stmt->bindParam(3, $school_year);
            $stmt->bindParam(4, $semester);
            $stmt->bindParam(5, $access_code);
            $stmt->bindParam(6, $permit);

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
