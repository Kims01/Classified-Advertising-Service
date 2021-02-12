<?php

class LuckyMember 
{
   private $luckyMemberId;
   private $memberID;
   private $regDate;
   private $expDate;
   private $discountRate;
   
   function __construct($memberID = null, $regDate = null,$expDate = null,$discountRate = null)
   {
       
       $this->regDate = $regDate;
       $this->expDate = $expDate;
       $this->discountRate = $discountRate;

   }
   

   
   public function getMemberID(){
       return $this->memberID;
   }
   
/**
     * @return mixed
     */
    public function getLuckyMemberId()
    {
        return $this->luckyMemberId;
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
     * @return mixed
     */
    public function getDiscountRate()
    {
        return $this->discountRate;
    }

/**
     * @param mixed $luckyMemberId
     */
    public function setLuckyMemberId($luckyMemberId)
    {
        $this->luckyMemberId = $luckyMemberId;
    }

    public function setMemberID($memberID)
    {
        $this->memberID = $memberID;
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

/**
     * @param mixed $discountRate
     */
    public function setDiscountRate($discountRate)
    {
        $this->discountRate = $discountRate;
    }

   
    
    public function insertLuckyMember($connection)
    {
        $sql = "insert into luckymember (MemberID, RegDate, ExpDate, DiscountRate) values ($this->memberID, '$this->regDate', '$this->expDate', $this->discountRate";
        $insert = $connection->exec($sql);
        return $insert;
    }
    
   
}
?>