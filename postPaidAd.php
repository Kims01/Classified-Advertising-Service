<?php
include_once 'db.php';
include_once 'advertisement.cls.php';
include_once 'image.cls.php';




if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(!empty($_FILES['file']))
    {
        $fileType=$_FILES["file"]["type"];
        $fileSize=$_FILES["file"]["size"];
        $fileName=$_FILES["file"]["name"];
        $fileErr=$_FILES["file"]["error"];
        $fileTmp=$_FILES["file"]["tmp_name"];
        
        if($fileErr==0)
        {
            move_uploaded_file($fileTmp, "image/".$fileName);
            echo '<script language="javascript">';
            echo 'alert("Ad posted!")';
            echo '</script>';
        }
        
    }
}



if($_SERVER["REQUEST_METHOD"] == "POST")
{
    header('location: paymentConfirmation.php');
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>KIJIJI</title>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="#" crossorigin="anonymous">
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="jquery-1.4.1.min.js"></script>
  <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
     



      .btn-gray{
          background-color:#ccc;
          background-image:-moz-linear-gradient(#f4f4f4,#bcbcbc);
          background-image:-webkit-linear-gradient(#f4f4f4,#bcbcbc);
          background-image:-ms-linear-gradient(#f4f4f4,#bcbcbc);
          border-color:#aaa;
          color:#000}


      .btn-file{
          position:relative
      }


      .btn-file input[type=file]{
          position:absolute;
          top:0;
          right:0;
          min-width:100%;
          min-height:100%;
          font-size:999px;
          text-align:right;
          filter:alpha(opacity=0);
          opacity:0;
          cursor:inherit;
          display:block}input[readonly]{background-color:#fff!important;cursor:text!important}
    .center {
      margin: auto;
      width: 40%;
      border: 3px solid #D3D3D3;
      padding: 20px;

    </style>
    

</head>

<body onload="myFunction()">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">KIJIJI</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
     
    </ul>
  </div>
</nav>
<br /><br /><br /><br />
<div class="center">
<form name="myForm" method="get" action="" enctype="multipart/form-data">
 
<h4>Paid Post(Add Pictures)</h4>

<label>Number of pictures :</label> 

<select name="picNum">

<?php
   for($i=1;$i<=10;$i++)
   {
      ?>
        <option value="<?php echo $i ?>"><?php echo $i; ?></option>
        <?php
   }    
?>
</select>
<button class="btn btn-gray"  type="submit" >OK</button> 
</form>
<br />
<?php 
if(isset($_GET['picNum']))
{
    $imageNum=0;
    $imageNum = $_GET['picNum'];
    if($imageNum>=1)
    {
        for($j=0;$imageNum>$j;$j++)
        {
            echo"<input name='file' id='file' type='file' size=4  multiple><button type='button' >Upload</button>";
        }
    }
}


?>


<br /><br />
<form class="form-signin" method="post" action="#">
<button class="btn btn-gray"  type="submit" >Payment</button>  
</form>

               

</div>
<br />


</body>
</html>