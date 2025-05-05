<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        form {
            border: 2px solid black;
            width: fit-content;
            padding: 20px;
        }
    </style>
</head>
<body>
    <?php
        $con = mysqli_connect("localhost", "root", "", "webquiz");
    ?>
    <form method = "post">
        Pilih quiz: <select name="quizChosen">
            <?php
                $quizzes = mysqli_query($con, "SELECT * FROM quiz");
                while($quiz = mysqli_fetch_array($quizzes)) {
                    echo "<option value = '" . $quiz["quizID"] . "'>" . $quiz["quizName"] . "</option>";
                }
            ?>
        </select>
        <input type="submit">
    </form>
    <?php
        if(isset($_POST["quizChosen"])) {
            $quizChosen = $_POST["quizChosen"];
            $studentID = 1; 
            echo "<form action = 'hasilQuiz.php' method = 'post'>";
            echo "<input type = 'hidden' value = '$studentID' name = 'studentID'>";
            echo "<input type = 'hidden' value = '$quizChosen' name = 'quizID'>";
            $quizzes = mysqli_query($con, "SELECT * FROM quiz WHERE quizID = $quizChosen");

            $quiz = mysqli_fetch_array($quizzes);
            echo $quiz["quizName"];
            echo "<br>Soal: <br>";
            $soal = mysqli_query($con, "SELECT * FROM question WHERE quizID = $quizChosen");

            while($question = mysqli_fetch_array($soal)) {
                echo $question["question"] . "<br>";
                $questionID = $question["questionID"];
                $pilihan = mysqli_query($con, "SELECT * FROM choices WHERE questionID = $questionID");
                while($choice = mysqli_fetch_array($pilihan)) {
                    echo "<input type = 'radio' value = '" . $choice["choiceType"] . "' name = '" . $question["questionID"] . "' required>";
                    echo $choice["choiceType"] . ". " . $choice["choiceText"] . "<br>";
                }
                echo "<br>";
            }
            echo "<input type = 'submit'>";
            echo "</form>";
        }

        
    ?>
</body>
</html>