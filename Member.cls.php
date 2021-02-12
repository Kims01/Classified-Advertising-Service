<?php

class Member
{
    private $memberId;
    private $name;
    private $address;
    private $city;
    private $state;
    private $phone;
    private $email;
    private $password;
    private $memberType;
    
    function __construct($name=null,$address=null,$city=null,$state=null,$phone=null,$email=null,$password=null,$memberType=null)
    {
        $this->name=$name;
        $this->address=$address;
        $this->city=$city;
        $this->state=$state;
        $this->phone =$phone;
        $this->email=$email;
        $this->password=$password;
        $this->memberType=$memberType;
    }
    
    /**
     * @return mixed
     */
    public function getMemberId()
    {
        return $this->memberId;
    }
    
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }
    
    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }
    
    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }
    
    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }
    
    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }
    
    /**
     * @return mixed
     */
    public function getMemberType()
    {
        return $this->memberType;
    }
    
    /**
     * @param mixed $memberId
     */
    public function setMemberId($memberId)
    {
        $this->memberId = $memberId;
    }
    
    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
    
    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }
    
    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }
    
    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }
    
    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }
    
    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
    
    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
    
    /**
     * @param mixed $memberType
     */
    public function setMemberType($memberType)
    {
        $this->memberType = $memberType;
    }
    
    public function insertMember($connection)
    {
        $sql = "insert into member (Name, Address, City, State, Phone, Email, Password, MemberType) values ('$this->name', '$this->address', '$this->city', '$this->state', '$this->phone', '$this->email', '$this->password', $this->memberType)";
        $insert = $connection->exec($sql);
        return $insert;
    }
    public function deleteMember($connection, $memberID)
    {
        $sql = "delete from member where MemberID=$memberID";
        $delete = $connection->exec($sql);
        return $delete;
    }
    
}


?>