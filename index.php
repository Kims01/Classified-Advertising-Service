<?php
include_once 'dbConfig.php';
include_once 'advertisement.cls.php';

$connection = new PDO("mysql:host=$hostname;dbname=$dbname",$username,$password);

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<meta charset="utf-8">
<title>Welcome to KIJIJI</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<!-- Start Nav Bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
<a class="navbar-brand" href="#">KIJIJI</a> <!-- Need to set the address for this button -->
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>


<div class="d-flex justify-content-end">
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
<!-- Start Home button (Current) -->
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
<!-- Start Register button -->
        <a class="nav-link" href="registration.php">Register</a>
      </li>
      <li class="nav-item">
<!-- Start Post button -->
        <a class="nav-link" href="postAd.php">Post</a>
      </li>
      <li class="nav-item">
<!-- Start Language button -->
        <a class="nav-link" href="#">EN / FR</a>
      </li>
      <li class="nav-item">
<!-- Start Login button -->
        <a class="nav-link" href="signIn.php">Log In</a>
      </li>
    </ul>
   </div>
</div>
</nav>

<?php 
session_start();
if(isset($_GET['logout']))
{
    unset($_SESSION["refUser"]);
    header("Location: index.php");
}
    
if(isset($_SESSION['refUser']))
{
    $curID = $_SESSION['refUser'];
    $currMemQuery = "select * from member where MemberID = ".$curID;
    $memFound = $connection -> prepare($currMemQuery);
    $memFound->execute();
    $member = $memFound->fetch();   
    
    echo "<table class='table table-borderless'>
              <tbody>
                <tr class='text-center table-info'>
                  <th scope='row'>Welcome, ".$member["Name"]."!
                </tr>
                <tr class='text-center table-info'>
                  <td class='text-center'>
                    <a href='manage.php' style='padding-top:20px;'><button type='button' class='btn btn-outline-primary'> Manage My Posts";
    
    if($member["MemberType"] == 2)
    {
        echo " & Members";
    }
                       echo "</button>
                    </a>
                 </td>
                </tr>
                <tr class='text-center table-info'>
                <td class='text-center'>
                    <a href='index.php?logout=yes style='padding-top:20px;'>
                        <button type='button' class='btn btn-outline-primary'>Sign Out</button>
                    </a>
                 </td>
                </tr>
            </tbody>
        </table>";
    if($member["MemberType"] == 2)
    {
        echo '<a href="DrawLuckyMember.php">';
        echo '<button class="btn btn-outline-success my-2 my-sm-0">Draw Lucky Member</button> </a>';
    }
                       
}


?>

<!--  Special Ads  -->
<div class="container">
<a href="#"><h2 class="p-3">Special Ads</h2></a> 

<div class="card-group">
<?php 
$advert = "select * from advertisement where PaidAd = true";
$test=$connection->prepare($advert);
$test->execute();


foreach ($test->fetchAll(PDO::FETCH_ASSOC) as $row2)
{    
    echo "<a href= 'ItemView.php?id=".$row2["AdvertID"]."'><div class='card border-success mb-3' style='max-width: 18rem;'>
          <div class='card-header'>".$row2["Title"]."  </div>
          <div class='card-body text-success'>
            <h5 class='card-title'>$".$row2["Price"]."</h5>
            </div>
          </div></a>";
}

?>
</div>
</div>
<!-- divider -->

<div>
<p class = "display-4 text-center"> - - - </p>
</div>

<!-- divider end -->

<!-- Search -->
<div class = "container  p-3 mb-2 bg-light text-dark">
<div class="row">
<div class="col-md-6">
	<p class="h2 p-3"> Search Items By Keywords </p>
</div>
<div class="col-md-6">
	<form class="form-inline my-2 my-lg-0 p-3" action="#" method="get">
      <input class="form-control mr-sm-2 " type="search" placeholder="Search" aria-label="Search" name="keyword">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</div>
</div>
<!-- Search end-->


<!-- Search result display -->
<?php 

if(isset($_GET['keyword']))
{
    $key = $_GET['keyword'];
    $sql = "SELECT * FROM advertisement WHERE AdvertDesc LIKE '%$key%' OR Title LIKE '%$key%'";
    $adFound = $connection->prepare($sql);
    $adFound->execute();
    if($adFound->rowCount() != 0)
    {
        echo "<div class='container'><table class='table'>  
                <thead>
                    <tr>
                      <th scope='col'>Title</th>
                      <th scope='col'>Price</th>
                    </tr>
                </thead> 
                <tbody>";
        foreach ($adFound->fetchall(PDO::FETCH_ASSOC) as $row)
        {
            echo "<a href = 'ItemView.php?id=".$row["AdvertID"]."'>";
            echo "<tr>
                    
                    <td><a href = 'ItemView.php?id=".$row["AdvertID"]."'>".$row["Title"]."</a></td>
                    <td>".$row["Price"]."</td>
                 </tr>";
        }
        echo "</tbody></table></div>";
    }
    else 
    {
        echo "<p class='h5 text-center text-danger' style='padding:30px;'> NO SEARCH RESULT - Please change your criteria </p>";
    }
    
}

?>



<!--  Search result End -->
<!-- Category -->
<div class="container p-3">
<div class = "row">


<?php 
$category = "select * from category";
$test=$connection->prepare($category);
$test->execute();
foreach ($test->fetchAll(PDO::FETCH_ASSOC) as $row2)
{
    echo "<!-- Category Name-->
            <div class = 'col-md-4'>
            	<h4> ".$row2["Desc_Eng"]." </h4>
            	<!-- Sub Category start -->
		          <ul>";
        
        $subcategory = "select * from subcategory where CategoryID = ".$row2["CategoryID"];
        $test2 = $connection->prepare($subcategory);
        $test2->execute();
        foreach ($test2 -> fetchAll(PDO::FETCH_ASSOC) as $row3)
        {
            echo "<a href='categoryArticle.php?id=".$row3["SubCategoryID"]."'> <li>".$row3["Desc_Eng"]."</li> </a>";
        }
echo "</ul>
	<!-- Sub Category end -->
	</div>";
}
?>



</div>
</div>


</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
