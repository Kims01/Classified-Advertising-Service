<?php 
require_once('dbConfig.php');

$connection = new PDO("mysql:host=$hostname;dbname=$dbname",$username,$password);

$subCategoryID  = $_GET['id'];


?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>KIJIJI</title>

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
      .etc-login-form {
        color: #919191;
        padding: 10px 20px;
      }
      .etc-login-form p {
        margin-bottom: 5px;
      }

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
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <div class="dropdown show">
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php 
          $subcat = "select * from subcategory where SubCategoryID = ".$subCategoryID;
          $subcatfound = $connection -> prepare($subcat);
          $subcatfound->execute();
          $subcatcatname = $subcatfound->fetch();         
          $category = "select * from category where CategoryID = ".$subcatcatname["CategoryID"];
          $categoryfound = $connection->prepare($category);
          $categoryfound->execute();
          $categoryname =  $categoryfound->fetch();
          echo "".$categoryname["Desc_Eng"]."";
          ?>
        </a>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
          <?php   
          $subcat = "select * from subcategory where CategoryID = ".$categoryname["CategoryID"];
          $subcatfound = $connection -> prepare($subcat);
          $subcatfound->execute();
          foreach ($subcatfound->fetchall(PDO::FETCH_ASSOC) as $row1)
          {
              echo "<a class='dropdown-item' href='categoryArticle.php?id=".$row1["SubCategoryID"]."'>".$row1["Desc_Eng"]."</a>";      
          }
          ?>         
        </div>
      </div>
    </ul>
  </div>
</nav>


<div class="album py-5 bg-light">
    <div class="container">

      <div class="row">
      
      <?php 
      $advert = "select * from advertisement where SubCategoryID = ".$subCategoryID;
      $test=$connection->prepare($advert);
      $test->execute();
      foreach ($test->fetchAll(PDO::FETCH_ASSOC) as $row2)
      {
          echo "<a href= 'ItemView.php?id=".$row2["AdvertID"]."'><div class='card text-white bg-dark mb-3' style='max-width: 18rem;'>
                  <div class='card-header'>".$row2["Title"]."</div>
                  <div class='card-body'>
                    <h5 class='card-title'> $".$row2["Price"]."</h5>
                    <p class='card-text'>".$row2["AdvertDesc"]."</p>
                  </div>
                  </div>
                </a>";      
      }
      
      ?>
      
      
      <hr>

  <footer class="text-muted">
    <div class="container">
      <p class="float-right">
        <a href="#">Back to top</a>
      </p>


    </div>
  </footer>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>