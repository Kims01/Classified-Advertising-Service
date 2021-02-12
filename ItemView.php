<?php 

require_once('dbConfig.php');

$connection = new PDO("mysql:host=$hostname;dbname=$dbname",$username,$password);

$itemID  = $_GET['id'];

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
<a class="navbar-brand" href="index.php">KIJIJI</a> <!-- Need to set the address for this button -->
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>


<div class="d-flex justify-content-end">
<div class="collapse navbar-collapse" id="navbarSupportedContent">
<ul class="navbar-nav mr-auto">
<!-- Start Home button (Current) -->
<li class="nav-item active">
<a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
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
<!--  Special Ads  -->
<div class="container">
<a href="#"><h2 class="p-3">Special Ads </h2></a>
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
<p class = "display-4 text-center">  </p>
</div>

<!-- divider end -->

<!-- Title   -->
<div class = "container p-3 mb-2 bg-light text-dark">
	<p class="h3 p-3 text-center">
	<?php 
	
          $currItem = "select * from advertisement where AdvertID = ".$itemID;
          $itemFound = $connection -> prepare($currItem);
          $itemFound->execute();
          $item = $itemFound->fetch();         
   
          echo $item["Title"];
    ?>
    </p>
</div>
<!-- Title end-->

<!-- Info Table -->
<div class="container p-3">
  <table class="table">
    <tbody>
      <tr>
        <th>Price : </th>
        <td><?php echo "$ ".$item["Price"];
          ?></td>
        <th>Seller : </th>
        <td><?php 
        $currMem = "select * from member where MemberID = ".$item["MemberID"];
        $memFound = $connection -> prepare($currMem);
        $memFound->execute();
        $member = $memFound->fetch();   
        echo $member["Name"]?></td>
      </tr>
      <tr>
        <th>Address : </th>
        <td><?php echo $member["City"] ?></td>
        <th>Phone : </th>
        <td><?php echo $member["Phone"] ?></td>
      </tr>
    </tbody>
  </table>
</div>
<!-- Info Table end -->
<!-- Image display -->
<div class= "container text-center p-3 border border-success rounded">
  <?php 
        $photosql = "select * from images where AdvertID =".$itemID;
        $photosqlexecute=$connection->prepare($photosql);
        $photosqlexecute->execute();
        
        if($photosqlexecute->rowCount() == 0)
        {
            echo "<p class='text-center text-warning' style='padding:30px;'>This is a free ad - No Image</p>";
        }
        else 
        {
            foreach ($photosqlexecute->fetchAll(PDO::FETCH_ASSOC) as $row1)
            {    
                echo "<img src='images/".$row1["Source"]."' alt='Item thumbnail' class='img-thumbnail'>";
            }  
        }
    ?>

</div>
<!-- Image display -->
<!-- Ad Body -->
<div class = "container p-3 mb-2 bg-light text-dark border border-success rounded">
<?php echo $item["AdvertDesc"] ?></div>
<!-- Ad Body end -->

<!-- Go back button start-->
<div class="container p-3 text-center">
<a href="categoryArticle.php?id=<?php echo $item["SubCategoryID"]?>">  
<button type="button" class="btn btn-success">Go back to the item list</button>
</a>
<!-- Go back button end-->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body></html>
