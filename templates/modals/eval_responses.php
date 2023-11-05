<?php
require "../../config/connection.php";

$primary_id = $_POST['primary_id'];
$filteredWordsJson = file_get_contents('../filtered_words.json');
$filteredWordsArray = json_decode($filteredWordsJson, true);

$filteredWords = $filteredWordsArray['blocked_words'];
$sql = "SELECT report_id, rating, comment, sentiment FROM tb_reports WHERE evaluation_id = $primary_id ORDER BY rating DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!empty($result)) {
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
?>
        <tr>
            <td><button data-id="<?php echo $row["report_id"] ?>" class="view-report btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#reportModal"><?php echo $row["rating"] ?></button></td>
            <td><?php echo $filteredComment ?></td>
            <td><?php echo $row["sentiment"] ?></td>
        </tr>
<?php
    }
} else {
    echo "<tr><td colspan='3'>No results found.</td></tr>";
}

$stmt = null;
$conn = null;
?>