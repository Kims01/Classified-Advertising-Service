<?php
include_once 'dbConfig.php';
include_once 'Member.cls.php';
$connection = new PDO("mysql:host=$hostname;dbname=$dbname",$username,$password);

if(isset($_GET['delete']))
{
    $advertId= $_GET['delete'];
    
    $ad = new Advertisement();
    $ad->deleteanAd($connection, $advertId);
    
    header("Location: manage.php");
}
if(isset($_GET['deletemember']))
{
    $memID= $_GET['deletemember'];
    
    $del_mem = new Member();
    $done = $del_mem->deleteMember($connection, $memID);
    
    header("Location: manage.php");
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   
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
      <li class="nav-item">
        <a class="nav-link" href="#">Draw a lucky member for today</a>
      </li>
    </ul>
  </div>
</nav>

<br><br><br>

<?php 

    session_start();
    $userID  = $_SESSION['refUser'];
    $currMemQuery = "select * from member where MemberID = ".$userID;
    $memFound = $connection -> prepare($currMemQuery);
    $memFound->execute();
    $member = $memFound->fetch();
    
    $ad = "select * from advertisement where MemberID = ".$userID;
    $test=$connection->prepare($ad);
    $test->execute();
    
    if($test->rowCount()!=0)
    {
        echo "<div class='container'>";
        echo "<table class='table'>";
        echo "<thead>
            <tr>
              <th scope='col'>Advertisement ID</th>
              <th scope='col'>Title</th>
              <th scope='col'>Price</th>
              <th scope='col'>Delete?</th>
             </tr>
          </thead><tbody>";
    
    foreach ($test->fetchAll(PDO::FETCH_ASSOC) as $row)
    {
        echo "<tr><th scope='row'>".$row["AdvertID"]."</th><td><a href='ItemView.php?id=".$row['AdvertID']."'>".$row['Title']."</a></td><td>".$row['Price']."</td>";
        echo "<td><a href='manage.php?delete=".$row['AdvertID']."'>Delete</a><td>";
        echo "</tr>";
    }
    
        echo "</tbody></table>";
        echo "</div>";
    }
    
    if($member["MemberType"] == 2)
    {
        $ad = "select * from member";
        $test=$connection->prepare($ad);
        $test->execute();
        
        if($test->rowCount() != 0)
        {
            echo "<div class='container'>";
            echo "<table class='table'>";
            echo "<thead>
            <tr>
              <th scope='col'>Member ID</th>
              <th scope='col'>Full Name</th>
              <th scope='col'>Address</th>
              <th scope='col'>City</th>
              <th scope='col'>State</th>
              <th scope='col'>Phone</th>
              <th scope='col'>Email</th>
              <th scope='col'>Member Type</th>
              <th scope='col'>Delete?</th>
             </tr>
          </thead><tbody>";
        
        foreach ($test->fetchAll(PDO::FETCH_ASSOC) as $row1)
        {           
            echo "<tr><td>".$row1["MemberID"]."</td>";
            echo "<td>".$row1["MemberID"]."</td>";
            echo "<td>".$row1["Name"]."</td>";
            echo "<td>".$row1["Address"]."</td>";
            echo "<td>".$row1["City"]."</td>";
            echo "<td>".$row1["Phone"]."</td>";
            echo "<td>".$row1["Email"]."</td>";
            if($row1["MemberType"]==1)
            {
                echo "<td>Member</td>";                
            }
            if($row1["MemberType"]==2)
            {
                echo "<td>Admin</td>";
            }
            echo "<td><a href='manage.php?deletemember=".$row1['MemberID']."'>Delete</a><td>";
            echo "</tr>";
            
        }
        
            echo "</tbody></table>";
            echo "</div>";        
    }
    }
?>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>