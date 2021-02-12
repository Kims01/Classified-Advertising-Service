<?php

class Advertisement
{
    private $advertId;
    private $advertDesc;
    private $regDate;
    private $expDate;
    private $price;
    private $title;
    
    
    function __construct($advertDesc=null,$price=null,$title=null)
    {
        
        $this->advertDesc=$advertDesc;
        $this->regDate=new DateTime();
        $this->expDate=new DateTime();
        $this->price=$price;
        $this->title=$title;
    }
    
    /**
     * @return mixed
     */
    public function getAdvertId()
    {
        return $this->advertId;
    }
    
    /**
     * @return mixed
     */
    public function getAdvertDesc()
    {
        return $this->advertDesc;
    }
    
    /**
     * @return mixed
     */
    public function getRegDate()
    {
        return $this->regDate;
    }
    
    /**
     * @return mixed
     */
    public function getExpDate()
    {
        return $this->expDate;
    }
    
    /**
     * @param mixed $advertId
     */
    public function setAdvertId($advertId)
    {
        $this->advertId = $advertId;
    }
    
    /**
     * @param mixed $advertDesc
     */
    public function setAdvertDesc($advertDesc)
    {
        $this->advertDesc = $advertDesc;
    }
    
    /**
     * @param mixed $regDate
     */
    public function setRegDate($regDate)
    {
        $this->regDate = $regDate;
    }
    
    /**
     * @param mixed $expDate
     */
    public function setExpDate($expDate)
    {
        $this->expDate = $expDate;
    }
    
    public function postFreeAd($connection,$memberId,$subCaregoryId)
    {
        
        $advertDesc=$this->advertDesc;
        $regDate=new DateTime('now');
        $regTimeAsString = $regDate->format('Y-m-d H:i:s');
        $expDate=$regDate->modify('+9 day');
        $expTimeAsString = $expDate->format('Y-m-d H:i:s');
        $price=$this->price;
        $title=$this->title;
        
        
        $sqlCmd="Insert into advertisement  (MemberID,SubCategoryID,AdvertDesc,RegDate,ExpDate,Price,Title) values($memberId,$subCaregoryId,'$advertDesc', '$regTimeAsString','$expTimeAsString',$price,'$title')";
        
        $result = $connection->exec($sqlCmd);
        return  $result;
    }
    
    public function postPaidAd($connection,$paymentId,$memberId,$subCaregoryId)
    {
        
        $advertDesc=$this->advertDesc;
        $regDate=new DateTime('now');
        $expDate=$regDate->modify('+9 day');
        $regTimeAsString = $regDate->format('Y-m-d H:i:s');
        $expTimeAsString = $expDate->format('Y-m-d H:i:s');
        $price=$this->price;
        $title=$this->title;
        
        
        $sqlCmd="Insert into advertisement  (MemberID,PaymentID,SubCategoryID,AdvertDesc,RegDate,ExpDate,Price,Title) values($memberId,$paymentId,$subCaregoryId,'$advertDesc', '$regTimeAsString','$expTimeAsString',$price,'$title')";
        
        $result = $connection->exec($sqlCmd);
        return  $result;
    }
    
    public function deleteanAd($connection,$advertId)
    {
        $sqlCmd="Delete from advertisement where AdvertID=".$advertId;
        
        $result = $connection->exec($sqlCmd);
        
        return $result;
    }
    
    
    
}

?>