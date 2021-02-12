<?php
include('dbConfig.php');
$connection = new PDO("mysql:host=$hostname;dbname=$dbname",$username,$password);

if($_POST['id'])
{
    $id=$_POST['id'];
    
    $stmt = $connection->prepare("SELECT * FROM subcategory WHERE CategoryID=:id");
    $stmt->execute(array(':id' => $id));
    ?><option selected="selected">Select Subcategory :</option><?php
   while($row=$stmt->fetch(PDO::FETCH_ASSOC))
   {
      ?>
        <option value="<?php echo $row['SubCategoryID']; ?>"><?php echo $row['Desc_Eng']; ?></option>
        <?php
   }
}
?>