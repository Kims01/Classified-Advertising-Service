<?php

class Payment 
{
    private $paymentId;
    private $numberOfImage;
    private $duration;
    private $totalPayment;
    
    function __construct($numberOfImage,$duration,$totalPayment)
    {
        $this->numberOfImage = $numberOfImage;
        $this->duration = $duration;
        $this->totalPayment = $totalPayment;

    }
    
    /**
     * @return mixed
     */
    public function getPaymentId()
    {
        return $this->paymentId;
    }

    /**
     * @return mixed
     */
    public function getNumberOfImage()
    {
        return $this->numberOfImage;
    }

    /**
     * @return mixed
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @return mixed
     */
    public function getTotalPayment()
    {
        return $this->totalPayment;
    }

    /**
     * @param mixed $paymentId
     */
    public function setPaymentId($paymentId)
    {
        $this->paymentId = $paymentId;
    }

    /**
     * @param mixed $numberOfImage
     */
    public function setNumberOfImage($numberOfImage)
    {
        $this->numberOfImage = $numberOfImage;
    }

    /**
     * @param mixed $duration
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    /**
     * @param mixed $totalPayment
     */
    public function setTotalPayment($totalPayment)
    {
        $this->totalPayment = $totalPayment;
    }

    
}
?>