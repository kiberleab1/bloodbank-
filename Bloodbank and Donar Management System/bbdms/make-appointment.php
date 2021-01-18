<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['send']))
  {
$name=$_POST['fullname'];
$sex=$_POST['sex'];
$date=$_POST['date'];
$age=$_POST['age'];
$address=$_POST['address'];
$email=$_POST["email"];
$mobile=$_POST["mobile"];
$sql="INSERT INTO  tblappointment(fullname,sex,date,age,address,email,mobile) VALUES(:name,:sex,:date,:age,:address,:email,:mobile)";
$query = $dbh->prepare($sql);
$query->bindParam(':name',$name,PDO::PARAM_STR);
$query->bindParam(':sex',$sex,PDO::PARAM_STR);
$query->bindParam(':date',$date,PDO::PARAM_STR);
$query->bindParam(':age',$age,PDO::PARAM_STR);
$query->bindParam(':address',$address,PDO::PARAM_STR);
$query->bindParam(':mobile',$mobile,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Thank you placing a appointment we will be looking forward meeting you";
}
else 
{
$error="Something went wrong. Please try again";
}

}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Modern Business - Start Bootstrap Template</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Temporary navbar container fix -->
    <style>
    .navbar-toggler {
        z-index: 1;
    }
    
    @media (max-width: 576px) {
        nav > .container {
            width: 100%;
        }
    }
    </style>
    <style>
    .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
    </style>

</head>

<body>

    <?php include('includes/header.php');?>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <h1 class="mt-4 mb-3">Make Appointment</h1>

        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.php">Home</a>
            </li>
            <li class="breadcrumb-item active">Make Appointment</li>
        </ol>

        <!-- Content Row -->
        <div class="row">
            <!-- Map Column -->
              <div class="col-lg-8 mb-4">
                <h3>Pick A date to donor</h3>
                <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
        else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
                <form name="sentMessage"  method="post">
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Full Name:</label>
                            <input type="text" class="form-control" id="name" name="fullname" required data-validation-required-message="Please enter your name.">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Email:</label>
                            <input type="text" class="form-control" id="email" name="email" required data-validation-required-message="Please enter your name.">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Mobile:</label>
                            <input type="phone" class="form-control" id="mobile" name="mobile" required data-validation-required-message="Please enter your name.">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Sex:</label>
                            <select name="sex" id="sex" class="form-control"	>
  														<option value="male">Male</option>
													    <option value="female">Female</option>
    
  													</select>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Age:</label>
                            <input type="number" value="18" class="form-control" id="age" name="age" required data-validation-required-message="Please enter your name.">
                         
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Address:</label>
                            <input type="text" class="form-control" id="address" name="address" required data-validation-required-message="Please enter your name.">
                         
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Appointment Date:</label>
                            <input type="date" class="form-control" id="date" name="date" required data-validation-required-message="Please enter your email address.">
                        </div>
                    </div>
                    
                    <div id="success"></div>
                    <!-- For success/fail messages -->
                    <button type="submit" name="send"  class="btn btn-primary">Make Appointment</button>
                </form>
            </div>

            <!-- Contact Details Column -->
                    <?php 
$pagetype=$_GET['type'];
$sql = "SELECT Address,EmailId,ContactNo from tblcontactusinfo";
$query = $dbh -> prepare($sql);
$query->bindParam(':pagetype',$pagetype,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{ ?>
            <div class="col-lg-4 mb-4">
                <h3>Contact Details</h3>
                <p>
                   <?php   echo htmlentities($result->Address); ?>
                    <br>
                </p>
                <p>
                    <abbr title="Phone">P</abbr>: <?php   echo htmlentities($result->ContactNo); ?>
                </p>
                <p>
                    <abbr title="Email">E</abbr>: <a href="mailto:name@example.com"><?php   echo htmlentities($result->EmailId); ?>
                    </a>
                </p>
              <?php }} ?>
            </div>
        </div>
        <!-- /.row -->


    </div>
    <!-- /.container -->
<?php include('includes/footer.php');?>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/tether/tether.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Contact form JavaScript -->
    <!-- Do not edit these files! In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

</body>

</html>
