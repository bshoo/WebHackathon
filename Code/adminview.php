<!DOCTYPE html>
<html>
<head>
<title>Data</title>
<style>
    body{
        background-image: url("https://www.pesuacademy.com/Assessment/images/login-page-bg.jpg");
        background-repeat: no-repeat;
        background-size: 100%;
        background-position: top center;
        background-attachment: fixed;
        font-family: Arial, sans-serif;   
    }
    table {
      border-collapse: collapse;
      margin: 20px auto;
    }
    th, td {
      padding: 10px;
      border: 1px solid black;
      background-color: rgb(255,255,250);
      text-align: center;
    }
    th {
      background-color: lightblue;
    }
    .container {
        max-width: 100%;
        margin: 0 auto;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        position: absolute;
        left: 25%;
        top: 4%;
        align-items: center;
        background-color: rgba(255,255,250,0.74);
    }
    .total{
        background-color: rgba(255, 162, 0,0.5);
        font-weight: bold;
    }
    
</style>
</head><body>
    <div class="container"><center>
    <img src = "https://pes.edu/wp-content/uploads/2022/09/PESU-new-logo.png">
    <h1>PESSAT Registration Data</h1></center><hr>
    
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $conn = new mysqli($servername,$username,$password,"pes");
    if($conn->connect_error){
        die("Connection Failed ".$conn->connect_error);
    }
    $res = $conn->query("select * from seatsum");
    if($res->num_rows > 0){
      echo "<table><caption><h3>Remaining Seats<h3> </caption>";
      echo "<tr><th>Campus</th><th>AI</th><th>CS</th><th>EC</th><th>EE</th><th>BT</th><th>Total Remaining</th><th>Total seats</th><th>No of Enrolled</th><tr>";
        while($f = $res->fetch_assoc()){
            echo "<br> ";
            echo "</tr>";
            foreach($f as $k=>$v){
                echo "<td>$v</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
    else{
        echo "<table><th>Empty Table</th></table>";
    }
    $res = $conn->query("select sum(AI),sum(CS), sum(EC),sum(coalesce(EE,0)),sum(coalesce(BT,0)) from seats;");
    if($res->num_rows > 0){
      echo "<table>";
      echo "<tr><th>AI</th><th>CS</th><th>EC</th><th>EE</th><th>BT</th><tr>";
        while($f = $res->fetch_assoc()){
            echo "<br> ";
            echo "</tr>";
            foreach($f as $k=>$v){
                echo "<td>$v</td>";
            }
            echo "</tr>";
        }
        echo "<th colspan='5'>Out of</th>";
        echo "<tr><td>350</td><td>350</td><td>200</td><td>50</td><td>50</td></tr>";
        echo "</table>";
    }
    else{
        echo "<table><th>Empty Table</th></table>";
    }
    $res = $conn->query("select name, phone, email, branch from student s, dd where s.token = dd.token and campus=  'RR'");
    if($res->num_rows > 0){
      
      echo "<table><caption><h3>Students at RR Campus</h3></caption>";
      echo "<tr><th>Name</th><th>Phone</th><th>Email</th><th>Branch</th></tr>";
      $i = 0;
        while($f = $res->fetch_assoc()){
            echo "<br> ";
            echo "<tr>";
            foreach($f as $k=>$v){
                echo "<td>$v</td>";
            }
            echo "</tr>";
            $i++;
        }
        echo "<th colspan = '2' class='total'>Total</th><td colspan = '2' class='total'>$i</td>";
        echo "</table>";
    }
    else{
        echo "<table><th>Empty Table</th></table>";
    }
    $res = $conn->query("select name, phone, email, branch from student s, dd where s.token = dd.token and campus=  'EC'");
    if($res->num_rows > 0){
      
      echo "<table><caption><h3>Students at EC Campus</h3></caption>";
      echo "<tr><th>Name</th><th>Phone</th><th>Email</th><th>Branch</th></tr>";
      $i = 0;
        while($f = $res->fetch_assoc()){
            echo "<br> ";
            echo "<tr>";
            foreach($f as $k=>$v){
                echo "<td>$v</td>";
            }
            echo "</tr>";
            $i++;
        }
        echo "<th colspan = '2' class='total'>Total</th><td colspan = '2' class='total'>$i</td>";
        echo "</table>";
    }
    else{
        echo "<table><th>Empty Table</th></table>";
    }
    $res = $conn->query("select coalesce(sum(DDamount),0) as s from dd;");
    if($res->num_rows > 0){
        $res = $res->fetch_assoc();
        $res = $res["s"];
        echo "<table><th class = 'total'>Total Amount Collected</th><td class = 'total'>Rs $res</td></table>";
    }
    else{
        echo "<table><th>Empty Table</th></table>";
    }
    ?>
</div>
<script type="text/javascript" src="adminvalidate.js"></script>
</body>
</html>