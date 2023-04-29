<?php

require "../../../vendor/autoload.php";

use Sentiment\Analyzer;

function getSentiment($comment)
{
    $analyzer = new Analyzer();
    $scores = $analyzer->getSentiment($comment);

    if (isset($scores['compound'])) {
        $compoundScore = $scores['compound'];

        if ($compoundScore > 0.05) {
            return "Positive";
        } elseif ($compoundScore < -0.05) {
            return "Negative";
        } else {
            return "Neutral";
        }
    } else {
        return "N/A";
    }
}

function translate($q, $sl, $tl)
{
    $res = file_get_contents("https://translate.googleapis.com/translate_a/single?client=gtx&ie=UTF-8&oe=UTF-8&dt=bd&dt=ex&dt=ld&dt=md&dt=qca&dt=rw&dt=rm&dt=ss&dt=t&dt=at&sl=" . $sl . "&tl=" . $tl . "&hl=hl&q=" . urlencode($q), $_SERVER['DOCUMENT_ROOT'] . "/transes.html");
    $res = json_decode($res);
    if (isset($res[0][0][0])) {
        return $res[0][0][0];
    } else {
        return $q;
    }
}
