<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PES Student Registration</title>

    <style>
        body{
            background-image: url("https://www.pesuacademy.com/Academy/images/login_bg_acdemy.jpg");
            background-repeat: no-repeat;
            background-size: 100%;
            background-position: top center;
            
        }
        div { 
            padding: 1em; 
            margin: 0.5em; 
        }
        .errors { 
            background-color: rgba(255,0,0,1); 
            font-size: 1.2em;
            color: white;
            position: absolute;
            top: 25%;
            right: 5%;
            width: 25%;
            height: 5%;
            padding: 1%;
            
        }
        #form { 
            background-color: rgba(255,255,250,0.85);
            align: center; 
            width: 30%;
            position: absolute;
            left: 33%;
            top: 25%;
            border-radius: 5px;
        }
        table{
            padding: 1em;
        }
        td{
            padding: 0.5em;
        }
        input{
            background: transparent;
            height: 1.5em;
            font-size: 1.112em;
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
            bottom: -25%;
            right: 0.1%
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
    <script type="text/javascript" src="validate.js"></script>
</head>
<body>
<img src="https://pes.edu/wp-content/uploads/2022/09/PESU-new-logo.png">
<?php

$count_val_error = 0;

function errorDisplay($message) {
    global $count_val_error;

    if($count_val_error == 0)
    echo "<div class='errors'>$message</div>";
    
    $count_val_error++;
}


function cleaninput($input) {
    return htmlspecialchars(stripslashes(trim($input)));
}

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $student_info = array();

    if(preg_match("/^[a-zA-z ]+$/i", $_POST['name']))
        $student_info['name'] = strtoupper(cleaninput($_POST['name']));
    else
        errorDisplay('Enter Valid Name');

    if((int)$_POST['rank'] >= 1 && (int)$_POST['rank'] <= 15000)
        $student_info['rank'] = cleaninput((int)$_POST['rank']);
    else
        errorDisplay('Enter valid Rank, between 1 and 15000 only');
    
    if((float)$_POST['sslc'] >= 1 && (float)$_POST['sslc'] <= 10)
        $student_info['sslc'] = cleaninput((float)$_POST['sslc']);
    else
        errorDisplay('Enter valid CGPA, between 1 and 10 only');

    if((float)$_POST['puc'] >= 1 && (float)$_POST['puc'] <= 10)
        $student_info['puc'] = cleaninput((float)$_POST['puc']);
    else
        errorDisplay('Enter valid CGPA, between 1 and 10 only');
    
    if(preg_match("/^\d{10}$/", $_POST['phone']))
        $student_info['phone'] = cleaninput($_POST['phone']);
    else
        errorDisplay('Enter valid 10 digit phone number');
    
    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        $student_info['email'] = cleaninput($_POST['email']);
    else
        errorDisplay('Enter valid Email Address');
    
    if($_POST['campus']=="Ring Road")
        $student_info['campus'] = "RR";
    else{
        $student_info['campus'] = "EC";
    }

    $student_info['branch'] = $_POST['branch'];
    
    if($count_val_error == 0) {
        

        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "PES";
        $conn = new mysqli($servername,$username,$password,$db);
        
        extract($student_info);
        $res = $conn->query("select ifnull($branch,0) as $branch from seats where campus = '$campus'");
        $row = $res->fetch_assoc();
        if((int)$row["$branch"] == 0){
            errorDisplay("Branch Full, no more seats left ");
        }
        else{
            $st = "'".$name."',".$rank.",".$sslc.",".$puc.",".$phone.",'".$email."','".$campus."','".$branch."'";
            $conn->query("insert into student(name, rank, sslc, puc, phone, email, campus, branch) values($st)");
        }
        $conn->close();
    }
}

if($_SERVER['REQUEST_METHOD'] == "GET" || $count_val_error > 0) {
?>

<div id="form" align="center">
    <img src="https://www.pesuacademy.com/Academy/images/pesuimages/logoPesu.png" align="center">
    <h2 align="center">PESSAT Registration</h2>
    <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
        <table align="center">
            <tr><td><label>Student Name:</label></td>
            <td>
                <input name="name"/>
            </td>
            </tr>

            <tr><td><label>PESSAT Rank:</label></td>
            <td>
                <input name="rank" type="number"/>
            </td>
            </tr>

            <tr><td><label>SSLC/10th CGPA:</label></td>
            <td>
                <input name="sslc" type="text"/>
            </td>
            </tr>
            <tr><td><label>PUC/12th CGPA:</label></td>
            <td>
                <input name="puc" type="text"/>
            </td>
            </tr>

            <tr><td><label>Phone No:</label></td>
            <td>
                <input name="phone"/>
            </td>
            </tr>

            <tr><td><label>Email Address:</label></td>
            <td>
                <input name="email"/>
            </td>
            </tr>

            <tr><td><label>Campus: </label></td>
            <td>
                <select name="campus" onclick="validate_branch(this)">
                    <option>Ring Road</option>
                    <option>Electronic City</option>
                </select>
            </td>
            </tr>

            <tr><td><label>Branch: </label></td>
            <td>
                <label>AI</label><input name="branch" type="radio" value="AI" checked/>
                <label>CS</label><input name="branch" type="radio" value="CS"/>
                <label>EC</label><input name="branch" type="radio" value="EC"/>
                <label id="le">EE</label><input name="branch" type="radio" value="EE" id="ee" />
                <label id="lb">BT</label><input name="branch" type="radio" value="BT" id="bt" />
            </td>
            </tr>

            <tr>
            <td colspan="2">
                <center><input type="submit" value="Submit" id="sub"/></center>
            </td>
            </tr>
        </table>
    </form>
</div>

<?php
}
else {
    print "Student Succesfully Registered";
    header("Location: ./register_token_index.php");
}

?>
<div class="row">
    <p class="pull-left">Copyright © PES University, Bengaluru, India.</p>
</div>
</body>
</html>