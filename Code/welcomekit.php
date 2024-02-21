<?php
    function cleaninput($input) {
        return htmlspecialchars(stripslashes(trim($input)));
    }
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "PES";
        $conn = new mysqli($servername,$username,$password,$db);
        global $token;
        $token = (int)cleaninput($_POST["token"]);
        $ddnumber = (int)cleaninput($_POST["ddnumber"]);
        $ddamount = (float)cleaninput($_POST["ddamount"]);

        //$conn->query("insert into dd values($token, $ddnumber, $ddamount)");
        $conn->close();
    }       
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "PES";
    $conn = new mysqli($servername,$username,$password,$db);
    global $token;
    $res = $conn->query("select name as A from student where token = $token");
    $res = $res->fetch_assoc();
    $res = $res["A"];
    echo "<br>Dear $res, Welcome to PES ";
    $conn->close();
?>