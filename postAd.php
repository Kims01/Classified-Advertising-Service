<?php
include_once 'dbConfig.php';
include_once 'advertisement.cls.php';
include_once 'image.cls.php';
$connection = new PDO("mysql:host=$hostname;dbname=$dbname",$username,$password);



// $total = count($_FILES['upload']['name']);

// // Loop through each file
// for( $i=0 ; $i < $total ; $i++ ) {

//     //Get the temp file path
//     $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

//     //Make sure we have a file pathz
//     if ($tmpFilePath != ""){
//         //Setup our new file path
//         $newFilePath = "./uploadFiles/" . $_FILES['upload']['name'][$i];

//         //Upload the file into the temp dir
//         if(move_uploaded_file($tmpFilePath, $newFilePath)) {

//             //Handle other code here

//         }
//     }
// }


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
            move_uploaded_file($fileTmp, "images/".$fileName);
            echo '<script language="javascript">';
            echo 'alert("Ad posted!")';
            echo '</script>';
        }
        
    }
    
    
    // GET from session $memberID=$_POST['MemberID'];
    $subcategoryID=$_POST['subcategory'];
    $advertDesc=$_POST['message'];
    $price=$_POST['price'];
    $title=$_POST['title'];
    
    $advertisement = new Advertisement($advertDesc,$price,$title);
    $isPosted = $advertisement->postFreeAd($connection, 1, $subcategoryID);
    
    if($isPosted==true)
    {
        
        echo '<script language="javascript">';
        echo 'alert("Ad posted!")';
        echo '</script>';
        
        
        
        
    }
    else
    {
        echo '<script language="javascript">';
        echo 'alert("Ad not posted!")';
        echo '</script>';
        
    }
    

    
    
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
    
<script type="text/javascript">
function myFunction(){
     var x = document.getElementById("file");
     var txt = "";
     if ('files' in x) {
         if (x.files.length == 0) {
             txt = "<strong>Tip:</strong> Use the Control or the Shift key to <br />select multiple files.";
         } else {
             for (var i = 0; i < x.files.length; i++) 
                {
                               
                 txt += "<br><strong>" + (i+1) + ". file</strong><br>";
                 var file = x.files[i];
                 if ('name' in file) {
                     txt += "name: " + file.name + "<br>";
                 }
                 if ('size' in file) {
                     txt += "size: " + file.size + " bytes <br>";
                 }
             }
         }
     }
     else {
         if (x.value == "") {
             txt += "Select one or more files.";
         } else {
             txt += "The files property is not supported by your browser!";
             txt  += "<br>The path of the selected file: " + x.value; // If the browser does not support the files property, it will return the path of the selected file instead.
         }
     }
     document.getElementById("demo").innerHTML = txt;
     }
     
$(document).ready(function()
{
   $(".category").change(function()
   {
      var id=$(this).val();
      var dataString = 'id='+ id;
   
      $.ajax
      ({
         type: "POST",
         url: "getSubc.php",
         data: dataString,
         cache: false,
         success: function(html)
         {
            $(".subcategory").html(html);
         } 
      });
   });
   

   
});

function validateForm() 
{
     
     var x = document.forms["myForm"]["title"].value;
     if (x == "") {
       alert("Title must be filled out");
       return false;
     }
     x = document.forms["myForm"]["price"].value;
     if(isNaN(x))
     {
        alert("Price must be a nunmber");
          return false;
     }
     if (x == "") {
       alert("Price must be filled out");
       return false;
     }
     x = document.forms["myForm"]["message"].value;
     if (x == "") {
       alert("Message must be filled out");
       return false;
     }else
     {
        return true;
     }
   }


</script>

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
<form name="myForm" method="post" onsubmit="return validateForm()" enctype="multipart/form-data">
 
<h4>Add New Post</h4>
                
<label>Category :</label> 
<select name="category" class="category">
<option selected="selected">--Select Category--</option>

<?php
$stmt = $connection->prepare("SELECT * FROM category");
   $stmt->execute();
   while($row=$stmt->fetch(PDO::FETCH_ASSOC))
   {
      ?>
        <option value="<?php echo $row['CategoryID']; ?>"><?php echo $row['Desc_Eng']; ?></option>
        <?php
   } 
?>
</select>
<br />
<label>Subcategory :</label> <select name="subcategory" class="subcategory">
<option selected="selected">--Select Subcategory--</option>

</select>
<br />
 <label>Title :</label>
 <input id="title" name="title" placeholder="Enter Title here"  type="text">
<br />
 <label>Price :</label>
 <input id="price" name="price" placeholder="Enter price here">
<br />
<label>Message :</label>
<textarea id="message" name="message" placeholder="Enter Message here"  ></textarea>
<br />

<input name="file" id="file" type="file" multiple size="10" onchange="myFunction();"><br /><br />
<button class="btn btn-gray"  type="submit" >Add New Post</button>  

<p id="demo"></p>
               
</form>
<a href="postPaidAd.php"><button class="btn btn-gray" >Post with pictures</button>  </a>
</div>
<br />


</body>
</html>