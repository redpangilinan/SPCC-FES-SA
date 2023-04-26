<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Setup evaluation variables and unset the evaluation session values
if (
    isset($_SESSION['eval_evaluation_id']) &&
    isset($_SESSION['eval_faculty_id']) &&
    isset($_SESSION['eval_school_year']) &&
    isset($_SESSION['eval_semester'])
) {
    $eval_evaluation_id = $_SESSION['eval_evaluation_id'];
    $eval_faculty_id = $_SESSION['eval_faculty_id'];
    $eval_school_year = $_SESSION['eval_school_year'];
    $eval_semester = $_SESSION['eval_semester'];
?>
    <script>
        const evalEvaluationId = <?php echo $eval_evaluation_id; ?>
    </script>
<?php
    unset($_SESSION['eval_evaluation_id']);
    unset($_SESSION['eval_faculty_id']);
    unset($_SESSION['eval_school_year']);
    unset($_SESSION['eval_semester']);
} else {
    header("Location: ./login.php");
    exit;
}

require "../../config/connection.php";

$stmt = $conn->prepare("SELECT firstname, lastname FROM tb_users WHERE user_id = :faculty_id");
$stmt->bindParam(":faculty_id", $eval_faculty_id);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$eval_faculty_name = $result['lastname'] . ", " . $result['firstname'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="../../public/css/style.css">
    <title>Student Evaluation</title>
</head>

<body>
    <header class="container-fluid my-3 overflow-hidden">
        <h1>Evaluation</h1>
        <hr>
    </header>
    <main class="container">
        <div class="alert alert-success" role="alert">
            <h3 class="alert-heading">Evaluations are confidential!</h3>
            <p>The instructor that you're evaluating won't be able to see your information. They can only see your ratings and your comment.</p>
        </div>
        <div class="d-flex flex-column flex-lg-row gap-3 mb-4">
            <div class="card align-self-start w-100" style="max-width: 25rem; min-width: 19rem;">
                <div class="card-header">
                    <span style="font-size: 1.3em;">Details</span>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h3>School Year</h3>
                        <p><?php echo $eval_school_year . " " . $eval_semester ?></p>
                    </div>
                    <div class="mb-3">
                        <h3>Instructor</h3>
                        <p><?php echo $eval_faculty_name ?></p>
                    </div>
                </div>
            </div>
            <div class="card w-100">
                <form id="evaluation_form" class="card-body">
                    <h3>Rating Legend</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered bg-white">
                            <thead>
                                <tr>
                                    <th>Strongly Disagree</th>
                                    <th>Disagree</th>
                                    <th>Neutral</th>
                                    <th>Agree</th>
                                    <th>Strongly Agree</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>2</td>
                                    <td>3</td>
                                    <td>4</td>
                                    <td>5</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <?php
                    // Prepare the SQL query
                    $sql =
                        "SELECT c.category, c.weight, q.question_id, q.question 
                        FROM tb_categories c
                        JOIN tb_questions q ON c.category_id = q.category_id
                        ORDER BY c.weight DESC";

                    // Execute the query and fetch the results
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // Group the results by category
                    $grouped_results = array();
                    foreach ($results as $row) {
                        $category = $row['category'];
                        if (!isset($grouped_results[$category])) {
                            $grouped_results[$category] = array();
                        }
                        $grouped_results[$category][] = $row;
                    }

                    // Build the tables
                    foreach ($grouped_results as $category => $rows) {
                        echo '<table class="table bg-white table-hover" data-weight="' . $rows[0]['weight'] . '" data-category="' . $category . '">';
                        echo '<thead class="table-dark">';
                        echo '<tr>';
                        echo '<th class="w-100">' . $category . '</th>';
                        for ($i = 1; $i <= 5; $i++) {
                            echo '<th>' . $i . '</th>';
                        }
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';
                        foreach ($rows as $row) {
                            echo '<tr>';
                            echo '<td class="w-100">' . $row['question'] . '</td>';
                            for ($i = 1; $i <= 5; $i++) {
                                echo '<td><input type="radio" name="category-' . $row['question_id'] . '" value="' . $i . '" required></td>';
                            }
                            echo '</tr>';
                        }
                        echo '</tbody>';
                        echo '</table>';
                    }

                    $stmt = null;
                    $conn = null;
                    ?>
                    <div class="my-3">
                        <label for="comment" class="form-label">Comment</label>
                        <textarea class="form-control" name="comment" id="comment" rows="4" placeholder="Comment"></textarea>
                    </div>
                    <div class="d-flex flex-row-reverse">
                        <button type="submit" class="btn btn-dark" id="submit_evaluation">Submit Evaluation</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="../../public/js/alerts.js"></script>
    <script src="../../public/js/ajax/evaluations/submitEvaluation.js"></script>
</body>

</html>