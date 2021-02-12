<?php

class Image 
{
   private $imageId;
   private $imageSource;
   
   function __construct($imageSource)
   {
       $this->imageSource = $imageSource;
       
   }
   
/**
     * @return mixed
     */
    public function getImageId()
    {
        return $this->imageId;
    }

/**
     * @return mixed
     */
    public function getImageSource()
    {
        return $this->imageSource;
    }

/**
     * @param mixed $imageId
     */
    public function setImageId($imageId)
    {
        $this->imageId = $imageId;
    }

/**
     * @param mixed $imageSource
     */
    public function setImageSource($imageSource)
    {
        $this->imageSource = $imageSource;
    }

   
   
}




?>