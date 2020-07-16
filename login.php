<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="./signup.css">
</head>
<?php
    //$usrn="";
    $usrnm=$pass="";$usrerr=$passerr="";$msg="";
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(empty($_POST["uname"])){
            $usrerr="Username required";
        }
        else{
            $usrnm=$_POST["uname"];
        }
    }
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(empty($_POST["pass"])){
            $passerr="Password required";
        }
        else{
            $pass=$_POST["pass"];
        }
    }
    echo $usrnm;
    if(isset($_POST["login"])){
        if($usrerr==""&&$passerr==""){
            $con=mysqli_connect('localhost','root','','covid') or die(mysql_error());
            if(!$con){
                echo "Connect failed: %s\n".mysqli_connect_error();
                exit();
            }
            $user=mysqli_query($con,"select * from signup where usrnm='$usrnm';");
            $nrows=mysqli_num_rows($user);
            if($nrows==0){
                $msg="Username does not exist!";
            }
            else{
                $pwd=mysqli_query($con,"select pass from signup where usrnm='$usrnm';");
                $status=mysqli_query($con,"select status from signup where usrnm='$usrnm';");
                while($row=mysqli_fetch_assoc($pwd)){
                    $cpwd=$row['pass'];
                }
                while($col=mysqli_fetch_assoc($status)){
                    $cstatus=$col['status'];
                }
                if(($cpwd==$pass)&&($cstatus=="negative")){
                    header("Location: ./negative.php?usernm=".urlencode($usrnm));
                }
                else if(($cpwd==$pass)&&($cstatus=="positive")){
                    header("Location: ./positive.php?usernm=".urlencode($usrnm));
                }
                else{
                    $msg="Incorrect username/password.....pls check!";
                }
            }
        }
        else{
            $msg="Asterisked fields are required!";
        }
    } 
?>
<body>
    <div class="log">
        <h1 id="heads"><span>CORONA SUPPORT LOGIN</span></h1>
        <form action="#" method="POST" id="box">
            <b>Username:</b><span id="uname" style="color:red;">*<?php echo $usrerr;?></span><input type="text" name="uname" placeholder="enter your registered username"><br/>
            <b>Password:</b><span id="pass" style="color:red;">*<?php echo $passerr;?></span><input type="password" name="pass" placeholder="******"><br/>
            <input type="submit" value="Login" name="login"><div style="color:red"><?php echo $msg?></div>
            <a href="signup.php"><p id="new">New user?Sign up here</p></a>
        </form>
    </div>
</body>
</html>