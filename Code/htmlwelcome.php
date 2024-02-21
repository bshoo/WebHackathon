<!DOCTYPE html>
<html>
<head>
<title>Welcome</title>
<style>
body {
background-color: black;
background-image: url("https://pes.edu/wp-content/uploads/2020/03/pes-ranked-slider-bg_30b5169c4f090cbaef9a730d58a372f4.jpg");
background-repeat: no-repeat;
background-size: 100%;
font-family: Arial, sans-serif;
margin: 0;

}

.container {
max-width: 700px;
margin: 0 auto;
padding: 20px;
background-image: url("https://www.pessat.com/img/promo-1.jpg");
background-repeat: repeat-Y;
background-attachment: fixed;
border-radius: 10px;
box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
position: absolute;
left: 2%;
top: 4%;
}

h1 {
text-align: center;
color: #003366;
}

h2 {
margin-bottom: 20px;
color: #003366;
}


.welcome-kit {
margin-top: 40px;
padding: 20px;
background-color: #4169cd8b;
border-radius: 10px;
box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
text-align: justify;
font-family: Arial, Verdana, sans-serif;
font-size: 1.25em;
}

.welcome-kit h3 {
margin-bottom: 20px;
color: #000000;
}

.row{
    display: block;
    background: transparent;
    color: #9b0000;
    font-family: "Open Sans", Helvetica, Arial, sans-serif;
    position: absolute;
    bottom: 1%;
    width: 100%;
    height: 20%;
    background: linear-gradient(45deg, rgba(0, 85, 255, 0.523) 0%, rgb(0, 0, 0) 79%);
}
.pull-right{
    font-family: "Noto Sans", sans-serif;
    float:right;
    margin-top: 8%;
}
@media (max-width: 768px) {
.container {
max-width: 90%;
}

}
</style>
</head>
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

        $conn->query("insert into dd values($token, $ddnumber, $ddamount)");
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
    $conn->close();
?>
<body>
    <div class="container">
    <img src = "https://pes.edu/wp-content/uploads/2022/09/PESU-new-logo.png">
    <h1>Welcome to PES University</h1>
    


    <div class="welcome-kit">
    <h3>Dear <?= $res ?>,</h3>

    <p>Congratulations on the complition of your admission.Today, the programs at <b>PES University</b> are sought after by students from around the country. Leading industries choose <b>PES University</b> when they need the right talent. One of the key reasons for this is the University's focus on admitting the best talent in India and abroad. We will ensure that you recieve the best education facilities, and once you put in your part of the effort, the world of opportunitues will open for you. Enjoy your time here! <b>Happy Learning!</b><br><sub>Please collect your backpack, diary and bottle from the counter.</sub></p>
    </div>
    </div>
    <div class="row">
        <p class="pull-right">Copyright © PES University, Bengaluru, India.</p>
    </div>
</body>
</html>