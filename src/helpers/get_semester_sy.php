<?php
function getSemesterSy()
{
    $currentMonth = date('m');
    $currentYear = date('Y');
    $semester = ($currentMonth >= 1 && $currentMonth <= 6) ? '2nd Semester' : '1st Semester';
    $schoolYear = ($currentMonth >= 1 && $currentMonth <= 6) ? ($currentYear - 1) . '-' . $currentYear : $currentYear . '-' . ($currentYear + 1);
    return array('school_year' => $schoolYear, 'semester' => $semester);
}
