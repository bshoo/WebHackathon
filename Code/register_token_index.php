<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <style>
        body {
            font-family: Arial, Verdana, sans-serif;
            font-size: 90%;
            color: #666;
            background-color: #f8f8f8;
            background-image: url("https://www.pesuacademy.com/Assessment/images/login-page-bg.jpg");
            background-repeat: repeat-Y;
            background-attachment: fixed;
            background-size: 100%;
            padding: 1em; 
            margin: 0.5em; 
            width: 50%;
            display: block;
            float: center;
            align-items: center;
        }
        fieldset {
            margin-top: 25%;
            border: 2px solid #d6d6d6;
            background-color: #ffffff;
            opacity: 0.7;
            width: 100%;
            margin-left: 45%;
            line-height: 1.9em;
            color: rgb(255,0,0);
        }
        input{
            background: transparent;
            height: 1.5em;
            font-size: 1.112em;
        }
        .title {
            font-weight: bold;
            background: transparent;
            color: fieldtext !important;
            height: 1.5em;
            font-size: 1.112em;
        }
        #ddform { 
            background-color: rgba(255,255,250,0.75);
            
            width: 30%;
            position: absolute;
            left: 34%;
            top: 50%;
            border-radius: 5px;
        }
        table{
            padding: 1em;
        }
        td{
            padding: 0.5em;
        }
        label,select{
            font-weight: bold;
            background: transparent;
            color: fieldtext !important;
            height: 1.5em;
            font-size: 1.112em;
        }
        .row{
            display: block;
            background: transparent;
            color: #000000;
            font-family: "Open Sans", Helvetica, Arial, sans-serif;
            position: absolute;
            right: 0.1%;
            bottom: -25%;
        }
        .chk{
            background: transparent;
            height: 1.7em;
            width: 1.7em;
        }
        #sub{
            width:350px;
            font-weight:bold;
            height:40px;
            background-color: #021b38;
            color: #fff;
        }
        #sub:hover{
            background-color: rgba(2, 27, 56,0.7);
        }
    </style>

<script type="text/javascript" src="validateformjs.js"></script>

</head>

<body><center>
<fieldset>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";

            $conn = new mysqli($servername,$username,$password,"PES");
            global $res;
            $res = $conn->query("select max(token) as A from student");
            $res = $res->fetch_assoc();
            $res = $res["A"];
            
            $slot = $conn->query("select timing as T from slots, student where rank between minrank and maxrank and token = $res ;");
            if($slot->num_rows > 0){
                $slot = $slot->fetch_assoc();
                $slot = $slot["T"];
                
                echo "<div class='display'><h1>Token: $res</h1>";
                echo "<h1>Time Slot: $slot</h1></div>";
                $result = $conn->query("select branch, campus from student where token = (select max(token) from student);");
                $result = $result->fetch_assoc();
                $branch = $result["branch"];
                $campus = $result["campus"];
                
                $conn->query("update seats set $branch = $branch-1 where campus = '$campus'");
                
                $conn->close();
            if($_SERVER['REQUEST_METHOD'] == "POST") {
        
            }
            }
            else{
                echo "<h1 style='font-size:120%'>Rank has to be under 5000 to get a slot, thank you for choosing PES, better luck next time!</h1>";
                global $x;
                $x=TRUE;
            }
                
        
            ?>


</fieldset></center>
<div id="ddform" align="center"><br>
    <img src="https://www.pesuacademy.com/Academy/images/pesuimages/logoPesu.png" align="center">
    <h2 align="center">Document Verification</h2>
    <form method="POST" action="htmlwelcome.php">
        <table align="center">
            <tr><td><label>Token Number:</label></td>
            <td>
                <input readonly name="token" value="<?= $res ?>"/>
            </td>
            </tr>

            <tr><td><label>DD Number:</label></td>
            <td>
                <input name="ddnumber" type="text" onchange="validateform()"/>
            </td>
            </tr>

            <tr><td><label>DD Amount:</label></td>
            <td>
                <input name="ddamount" type="text" onchange="validateform()"/>
            </td></tr>
            <tr><td colspan="2"><h2 align="center">Submitted Documents</h2></td></tr>
            <tr><td><label>SSLC</label></td>
            <td>
                <input name="sslc" type="checkbox" class="chk" onclick="validateform()"/>
            </td></tr>
            <tr><td><label>PUC</label></td>
            <td>
                <input name="sslc" type="checkbox" class="chk" onclick="validateform()"/>
            </td></tr>
            <tr><td><label>Fee Receipt</label></td>
            <td>
                <input name="sslc" type="checkbox" class="chk" onclick="validateform()"/>
            </td></tr>
            <tr><td><label>PESSAT Hall Ticket</label></td>
            <td>
                <input name="sslc" type="checkbox" class="chk" onclick="validateform()"/>
            </td></tr>
            <tr>
            <td colspan="2">
                <center><input id="sub" type="submit" value="Submit" disabled/></center>
            </td>
            </tr>
        </table>
    </form>
</div>
<?php
global $x;
if($x){
    echo "<script>document.getElementById('ddform').style.visibility = 'hidden'</script>";
}
else{
    echo "<script>document.getElementById('ddform').style.visibility = 'visible'</script>";
}
?>
<div class="row">
    <p class="pull-left">Copyright © PES University, Bengaluru, India.</p>
</div>

</body>

</html>