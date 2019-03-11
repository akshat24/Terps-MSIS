<?php 
        $server = "localhost";
        $username = "root";
        $password = "akshat";
        $dbname = "terpsmsis";

        $conn = mysqli_connect($server, $username, $password, $dbname);
        if(!$conn) {
            echo "<h1>not connected!! </h1>";
            die(mysql_error());
        }
?>