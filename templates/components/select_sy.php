<?php
require "../../config/connection.php";

include "../../src/helpers/get_semester_sy.php";
$semester_sy = getSemesterSy();
$curr_school_year = $semester_sy['school_year'];

$stmt = $conn->prepare("SELECT DISTINCT school_year FROM tb_evaluations ORDER BY school_year DESC");
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $school_year  = $row['school_year'];
    $selected = '';
    if ($school_year == $curr_school_year) {
        $selected = 'selected';
    }
    echo "<option value='$school_year' $selected>$school_year</option>";
}

$stmt = null;
$conn = null;
