<?php
    $con = mysqli_connect("localhost", "root", "", "webquiz");
    $quizChosen = $_POST["quizID"];
    $soal = mysqli_query($con, "SELECT * FROM question WHERE quizID = $quizChosen");
    while($question = mysqli_fetch_array($soal)) {
        $studentID = $_POST["studentID"];
        $questionID = $question["questionID"];
        $answerKey = $question["answerKey"];
        $answered = $_POST[$questionID];
        echo $questionID . ": " . $answered;
        if($answered == $answerKey) {
            echo " (benar)<br>";
        }
        else {
            echo " (salah)<br>";
        }
        if(mysqli_query($con, "INSERT INTO answered (studentID, questionID, answerChosen) VALUES ($studentID, $questionID, '$answered')")) {
            echo "Berhasil<br>";
        }
        else {
            echo "Gagal<br>";
        }
    }
?>