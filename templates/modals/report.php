<?php
require "../../config/connection.php";

$primary_id = $_POST['primary_id'];
$filteredWordsJson = file_get_contents('../filtered_words.json');
$filteredWordsArray = json_decode($filteredWordsJson, true);

$filteredWords = $filteredWordsArray['blocked_words'];
$sql = "SELECT rating, comment, responses, sentiment FROM tb_reports WHERE report_id = $primary_id";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$categories = array();
$ratings = array();

foreach ($result as $row) {
    $filteredComment = $row["comment"];
    $lowerCaseFilteredComment = strtolower($filteredComment);

    foreach ($filteredWords as $word) {
        $lowerCaseWord = strtolower($word);
        if (stripos($lowerCaseFilteredComment, $lowerCaseWord) !== false) {
            $filteredComment = preg_replace_callback(
                '/\b' . preg_quote($word, '/') . '\b/i',
                function ($match) {
                    return str_repeat('*', strlen($match[0]));
                },
                $filteredComment
            );
        }
    }

    $responses = json_decode($row['responses'], true);
    $total_rating = $row['rating'];
    $comment = $row['comment'];
    $sentiment = $row['sentiment'];

    foreach ($responses as $response) {
        $category = $response['category'];
        $rating = $response['answer'];
        $weight = $response['weight'];

        if (isset($categories[$category])) {
            $categories[$category]['count'] += 1;
            $categories[$category]['rating'] += $rating;
        } else {
            $categories[$category]['count'] = 1;
            $categories[$category]['rating'] = $rating;
            $categories[$category]['weight'] = $weight;
        }
    }
}

uasort($categories, function ($a, $b) {
    return $b['weight'] <=> $a['weight'];
});

echo '
<table class="table table-bordered">
    <thead>
        <th>Comment</th>
        <th>Sentiment</th>
    </thead>';
echo '<tbody>';
echo '<tr><td>' . $filteredComment . '</td><td>' . $sentiment . '</td><tr>';
echo '</tbody>';
echo '</table>';

echo '
<table class="table">
    <thead>
        <th>Category</th>
        <th>Rating</th>
    </thead>';
echo '<tbody>';
foreach ($categories as $category => $data) {
    $average_rating = round($data['rating'] / $data['count'], 2);
    $weight = $data['weight'];
    echo "<tr><td>$category ($weight%)</td><td>$average_rating</td></tr>";
}
echo "<tr><th>Total Weighted Rating</th><th>$total_rating</th></tr>";
echo '</tbody>';
echo '</table>';

$stmt = null;
$conn = null;
