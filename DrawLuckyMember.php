<?php

include_once 'dbConfig.php';
include_once 'LuckyMember.cls.php';
$connection = new PDO("mysql:host=$hostname;dbname=$dbname",$username,$password);

$luckymember = new LuckyMember();
$luckymember->setRegDate(date("Y-m-d"));
$luckymember->setExpDate(date('Y-m-d', strtotime($luckymember->getRegDate(). ' + 6 days')));

$ad = "select * from member";
$test=$connection->prepare($ad);
$test->execute();

$membernumber = $test->rowCount();
$randomlucky = rand(1, $membernumber);
$luckymember->setMemberID($randomlucky);

$randomdiscount = rand(25, 50);
$randomdiscount = $randomdiscount / 100;
$luckymember->setDiscountRate($randomdiscount);

$insertdone = $luckymember->insertLuckyMember($connection);

if($insertdone)
header('location:index.php');
else{
    echo '<script language="javascript">';
    echo 'alert( "memberid :';
    echo $luckymember->getMemberID()."Regdate : ".$luckymember->getRegDate()."ExpDate : ".$luckymember->getExpDate()."Discountrate:".$luckymember->getDiscountRate();
    echo '" )';
    echo '</script>'; 
}
   

?>