<?php
    $con = mysqli_connect("localhost", "root", "", "webquiz");
    mysqli_query($con, "DELETE FROM answered");
?>