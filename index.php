<?php
session_start();
error_reporting(0);
include('includes/config2.php');
if($_SESSION['login']!=''){
$_SESSION['login']='';
}


if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 60)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp


if(isset($_POST['login']))
{
if ($_POST["verficationcode"] != $_SESSION["vercode"] OR $_SESSION["vercode"]=='')
    {
    echo "<script>alert('Incorrect captcha');</script>" ;
    }
    else
		{

$email=$_POST['emailid'];
//$password=md5($_POST['password']);
$password=hash("sha512",$_POST['password']);

$sql ="SELECT EmailId,Password,StudentId,Status FROM tblstudents WHERE EmailId=:email and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
//$query-> bindParam(':StudentId', $StudentId, PDO::PARAM_STR);
//$sql -> bind_result($email,$password,$StudentId);
//$rs=$sql->fetch();
//$sql->close();
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$_SESSION['Studentid']=$StudentId;
// $date = new dateTime();
// $date = date_defult_timezone_set('UTC');
// $date = $date->format("y/m/d h:i:s");
// $date = $date->format("l jS \of F Y h:i:s A");

$date = date_default_timezone_set('UTC');
$date = (new DateTime())->format('Y-m-d H:i:s') . PHP_EOL;
$date = date_default_timezone_set('Europe/London');
$date = (new DateTime())->format('Y-m-d H:i:s');


if($query->rowCount() > 0)
{
 foreach ($results as $result) {
 $_SESSION['stdid']=$result->StudentId;

if($result->Status==1)
{
$_SESSION['login']=$_POST['emailid'];
echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";

  $ip=$_SERVER['REMOTE_ADDR'];
  $d=mktime(11, 14, 54, 8, 12, 2014);
  $fp = fopen('accounts.txt', 'a+');
    if(fwrite($fp, "$email   $date  $ip  $city"))  {
        echo 'saved';          
    }
fclose ($fp); 
} 

else {
echo "<script>alert('Your Account Has been blocked .Please contact admin');</script>";

}
}
} 

else{
echo "<script>alert('Invalid Details');</script>";
}
}}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>E Library | </title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
    <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
<div class="content-wrapper">
<div class="container">
<!--Slider---->
     <div class="row">
              <div class="col-md-10 col-sm-8 col-xs-12 col-md-offset-1">
                    <div id="carousel-example" class="carousel slide slide-bdr" data-ride="carousel" >
                    <div class="carousel-inner">
                        <div class="item active">
                            <img src="assets/img/1.jpg" alt="" />
                        </div>
                        <div class="item">
                            <img src="assets/img/2.jpg" alt="" />
                        </div>
                        <div class="item">
                            <img src="assets/img/3.jpg" alt="" /> 
                        </div>
                    </div>
                    <!--INDICATORS-->
                     <ol class="carousel-indicators">
                        <li data-target="#carousel-example" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example" data-slide-to="1"></li>
                        <li data-target="#carousel-example" data-slide-to="2"></li>
                    </ol>
                    <!--PREVIUS-NEXT BUTTONS-->
                     <a class="left carousel-control" href="#carousel-example" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#carousel-example" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
                </div>
              </div>
             </div>
<hr />



<div class="row pad-botm">
<div class="col-md-12">
<h4 class="header-line">Student LOGIN FORM</h4>
</div>
</div>
 <a name="ulogin"></a>            
<!--LOGIN PANEL START-->           
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" >
<div class="panel panel-info">
<div class="panel-heading">
 LOGIN FORM
</div>
<div class="panel-body">
<form role="form" method="post">

<div class="form-group">
<label>Enter Email id</label>
<input class="form-control" type="text" name="emailid" required autocomplete="off" />
</div>
<div class="form-group">
<label>Password</label>
<input class="form-control" type="password" name="password" required autocomplete="off"  />
<p class="help-block"><a href="user-forgot-password.php">Forgot Password</a></p>
</div>

<!--Cpatcha Image -->     <div class="form-group">
                             <input type="text"   name="verficationcode" maxlength="5" autocomplete="off" required  style="width: 200px;"  placeholder="Enter Captcha" autofocus />&nbsp;

                             <img src="captcha.php">
                           </div>   <!--Cpatcha Image -->


 <button type="submit" name="login" class="btn btn-info">LOGIN </button> | <a href="signup.php">Not Register Yet</a>
</form>
 </div>
</div>
</div>
</div>  
<!---LOGIN PABNEL END-->            
             
 
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
 <?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>

</body>
</html>
