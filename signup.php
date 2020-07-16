<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Signup</title>
    <link rel="stylesheet" href="./signup.css">
</head>

<?php
    $name=$usrnm=$pass=$age=$location=$status="";
    $namerr=$usrerr=$passerr=$agerr=$locationerr=$statuserr="";
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(empty($_POST["name"])){
            $namerr="Name required";
        }
        else{
            $name=$_POST["name"];
        }
    }
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
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(empty($_POST["mstatus"])){
            $statuserr="Medical status required";
        }
        else{
            $status=$_POST["mstatus"];
        }
    }
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(empty($_POST["age"])){
            $agerr="Age required";
        }
        else{
            $age=$_POST["age"];
        }
    }
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(empty($_POST["loc"])){
            $locationerr="Location required";
        }
        else{
            $location=$_POST["loc"];
        }
    }
  
    $msg="";$msg2="";
    if(isset($_POST["submit"])){
        
        if($namerr==""&& $usrerr==""&& $passerr==""){
            $con=mysqli_connect('localhost','root','','covid') or die(mysql_error());
            if (!$con) {
                echo "Connect failed: %s\n".mysqli_connect_error();
                exit();
            }
            $query=mysqli_query($con,"select * from signup where usrnm='$usrnm';") or die(mysqli_error($con));
    
            $nrows =mysqli_num_rows($query);
            if($nrows==0){
                $sql="insert into signup values('$name',$age,'$location','$status','$usrnm','$pass');";
                $result=mysqli_query($con,$sql) or die(mysqli_error($con));
                if($result){
                     $msg2="You have been registered successfully";
                     $msg="";
                }
                else{
                    $msg="Signup failed...please try again";
                }
            }
            else{
                $msg="Username already exists! Please try again with another.";
            }
            mysqli_close($con);
        }
        else{
            $msg=$msg."  The asterisked fields are required";
        }
    }
    else{
        echo 'Cannot connect to the DB';
    }
   
?>
<body>
    <div class="log">
        <h1 id="heads"><span>CORONA SUPPORT SIGNUP</span></h1>
        <form action="#" method="POST">
            <b>Name:</b><span id="nerr" style="color:red;">*<?php echo $namerr;?></span><input type="text" name="name" placeholder="MyName"><br/>
            <b>Age:</b><span id="agerr" style="color:red;">*<?php echo $agerr;?></span><input type="number" name="age" placeholder="MyAge"><br/>
            <b>Location:</b><span id="locationerr" style="color:red;">*<?php echo $locationerr;?></span><input type="text" name="loc" placeholder="MyLocation"><br/>
            <b>Status:</b><span id="statuserr" style="color:red;">*<?php echo $statuserr;?></span><input type="text" name="mstatus" placeholder="negative"><br/>
            <b>Username:</b><span id="userr" style="color:red;">*<?php echo $usrerr;?></span><input type="text" name="uname"><br/>
            <b>Password:</b><span id="paerr" style="color:red;">*<?php echo $passerr;?></span><input type="password" name="pass"><br/>
            <input type="submit" value="SUBMIT" name="submit"><div style="color:red"><?php echo $msg?><span style="color:green"><?php echo $msg2?></span></div>
            <a href="./login.php"><p id="new">Already have an account? Sign in</p></a>
        </form>
    </div>
</body>
</html>