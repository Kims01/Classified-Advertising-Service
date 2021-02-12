<?php
include_once 'dbConfig.php';
include_once 'Member.cls.php';

$connection = new PDO("mysql:host=$hostname;dbname=$dbname",$username,$password);


if($_SERVER["REQUEST_METHOD"] == "POST")
{
    
    if(isset($_POST["register"]))
    {
        
        $email = $_POST["email"];
        $name = $_POST["name"];
        $address = $_POST["address"];
        $city = $_POST["city"];
        $state = $_POST["state"];
        $phone = $_POST["phone"];
        $password = $_POST["password"];
        $passwordcheck = $_POST["passwordcheck"];
        $membertype = $_POST["membertype"];
        if($email != "" && $name != "" && $address != "" && $city != "" && $state != "" && $phone != "" && $password != "" && $membertype != "" )
        {
            if ($password==$passwordcheck)
            {
                try{
                    $member = new Member($name, $address, $city, $state, $phone, $email, $password, $membertype);
                    $register = $member->insertMember($connection);
                    
                    if($register == true)
                    {
                        echo '<script language="javascript"> alert("New member is registered. Please login.");</script>';
                        header("location:signIn.php");
                    }
                }
                catch (PDOException $e)
                {
                    $_SESSION["connectionfail"] = "Connection Failed ".$e->getMessage();
                    header("location:connectionError.php");
                }
            }
            else
            {
                echo "<script type='text/javascript'>alert('Please check your password again.');</script>";
            }
        }
        else
        {
            echo '<script language="javascript"> alert("Please enter all information.")</script>';
        }
    }
}




?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>KIJIJI</title>

    <style>
    .register{
  background: -webkit-linear-gradient(left, #3931af, #00c6ff);
  margin-top: 3%;
  padding: 3%;
}
.register-left{
  text-align: center;
  color: #fff;
  margin-top: 4%;
}
.register-left input{
  border: none;
  border-radius: 1.5rem;
  padding: 2%;
  width: 60%;
  background: #f8f9fa;
  font-weight: bold;
  color: #383d41;
  margin-top: 30%;
  margin-bottom: 3%;
  cursor: pointer;
}
.register-right{
  background: #f8f9fa;
  border-top-left-radius: 10% 50%;
  border-bottom-left-radius: 10% 50%;
}
.register-left img{
  margin-top: 15%;
  margin-bottom: 5%;
  width: 25%;
  -webkit-animation: mover 2s infinite  alternate;
  animation: mover 1s infinite  alternate;
}
@-webkit-keyframes mover {
  0% { transform: translateY(0); }
  100% { transform: translateY(-20px); }
}
@keyframes mover {
  0% { transform: translateY(0); }
  100% { transform: translateY(-20px); }
}
.register-left p{
  font-weight: lighter;
  padding: 12%;
  margin-top: -9%;
}
.register .register-form{
  padding: 10%;
  margin-top: 10%;
}
.btnRegister{
  float: right;
  margin-top: 10%;
  border: none;
  border-radius: 1.5rem;
  padding: 2%;
  background: #0062cc;
  color: #fff;
  font-weight: 600;
  width: 50%;
  cursor: pointer;
}
.register .nav-tabs{
  margin-top: 3%;
  border: none;
  background: #0062cc;
  border-radius: 1.5rem;
  width: 28%;
  float: right;
}
.register .nav-tabs .nav-link{
  padding: 2%;
  height: 34px;
  font-weight: 600;
  color: #fff;
  border-top-right-radius: 1.5rem;
  border-bottom-right-radius: 1.5rem;
}
.register .nav-tabs .nav-link:hover{
  border: none;
}
.register .nav-tabs .nav-link.active{
  width: 100px;
  color: #0062cc;
  border: 2px solid #0062cc;
  border-top-left-radius: 1.5rem;
  border-bottom-left-radius: 1.5rem;
}
.register-heading{
  text-align: center;
  margin-top: 8%;
  margin-bottom: -15%;
  color: #495057;
}
    </style>
  </head>
  <body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">KIJIJI</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">member <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="signIn.php">Sign in</a>
      </li>
    </ul>
  </div>
</nav>


<div class="container register">
                <div class="row">
                    <div class="col-md-3 register-left">
                        <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt=""/>
                        <h3>Welcome to Kijiji</h3>
                        <p>  already have an account? <a href="signin.html">Sign in here</a></p>
                        
                    </div>
                    <div class="col-md-9 register-right">
                        <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="member-tab" data-toggle="tab" href="#member" role="tab" aria-controls="member" aria-selected="true">Member</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="admin-tab" data-toggle="tab" href="#admin" role="tab" aria-controls="admin" aria-selected="false">Admin</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="member" role="tabpanel" aria-labelledby="member-tab">
                                <h3 class="register-heading">Registration</h3>
                                <form class="row register-form" method="post" action="#">
                                    <div class="col-md-6">
                                    <input type="hidden" name="membertype" value="1" />
                                      <div class="form-group">
                                          <input type="email" name="email" class="form-control" placeholder="Your Email(Username)*" value="" />
                                      </div>
                                      <div class="form-group">
                                          <input type="password" name="password" class="form-control" placeholder="Password *" value="" />
                                      </div>
                                      <div class="form-group">
                                          <input type="password" name="passwordcheck" class="form-control"  placeholder="Confirm Password *" value="" />
                                      </div>
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control" placeholder="Full Name *" value="" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                          <input type="text" name="address" class="form-control" placeholder="Address *" value="" />
                                      </div>
                                      <div class="form-group">
                                          <input type="text" name="city" class="form-control" placeholder="City *" value="" />
                                      </div>
                                      <div class="form-group">
                                          <input type="text" name="state" class="form-control" placeholder="State *" value="" />
                                      </div>
                                        <div class="form-group">
                                            <input type="text" name="phone" minlength="10" maxlength="10" name="txtEmpPhone" class="form-control" placeholder="Your Phone *" value="" />
                                        </div>
                                        <input type="submit" name="register" class="btnRegister"  value="Register"/>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade show" id="admin" role="tabpanel" aria-labelledby="admin-tab">
                                <h3  class="register-heading">Registration</h3>
                                <form class="row register-form" method="post" action="#">
                                    <div class="col-md-6">
                                    <input type="hidden" name="membertype" value="2" />
                                      <div class="form-group">
                                          <input type="email" name="email" class="form-control" placeholder="Your Email(Username)*" value="" />
                                      </div>
                                      <div class="form-group">
                                          <input type="password" name="password" class="form-control" placeholder="Password *" value="" />
                                      </div>
                                      <div class="form-group">
                                          <input type="password" name="passwordcheck" class="form-control"  placeholder="Confirm Password *" value="" />
                                      </div>
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control" placeholder="Full Name *" value="" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                          <input type="text" name="address" class="form-control" placeholder="Address *" value="" />
                                      </div>
                                      <div class="form-group">
                                          <input type="text" name="city" class="form-control" placeholder="City *" value="" />
                                      </div>
                                      <div class="form-group">
                                          <input type="text" name="state" class="form-control" placeholder="State *" value="" />
                                      </div>
                                        <div class="form-group">
                                            <input type="text" name="phone" minlength="10" maxlength="10" class="form-control" placeholder="Your Phone *" value="" />
                                        </div>
                                        <input type="submit" name="register" class="btnRegister"  value="Register"/>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>





    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
