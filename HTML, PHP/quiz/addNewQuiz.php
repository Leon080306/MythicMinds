<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New quiz</title>
</head>
<body>
    <form method = "post">
        <table>
            <tr>
                <td>Input teacher ID: </td>
                <td>
                    <select name="teacherID">
                        <?php
                            $con = mysqli_connect("localhost", "root", "", "webquiz");
                            $teachers = mysqli_query($con, "SELECT * FROM account WHERE role = 'T'");
                            while($teacher = mysqli_fetch_array($teachers)) {
                                echo "<option value = '" . $teacher["userID"] . "'>" . $teacher["name"] . "</option>";
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Quiz Name</td>
                <td><input type="text" name = "quizName"></td>
            </tr>
            <tr>
                <td>Mata Pelajaran</td>
                <td><input type="text" name = "mata"></td>
            </tr>
        </table>
        <input type="submit">
    </form>
    <?php
        if(isset($_POST["teacherID"]) && isset($_POST["quizName"]) && isset($_POST["mata"])) {
            $ownerID = $_POST["teacherID"];
            $quizName = $_POST["quizName"];
            $mata = $_POST["mata"];
            $con = mysqli_connect("localhost", "root", "", "webquiz");
            mysqli_query($con, "INSERT INTO quiz (ownerID, quizName, mataPelajaran) VALUES ($teacherID, '$quizName', '$mata')");
        }
    ?>
</body>
</html>