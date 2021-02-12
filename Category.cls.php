<?php

class Category
{
    private $categoryId;
    private $englishDesc;
    private $frenchDesc;
    
    
    function __construct($englishDesc,$frenchDesc)
    {
        $this->categoryId = self::$sequence++;
        $this->englishDesc = $englishDesc;
        $this->frenchDesc = $frenchDesc;
    }
        
    
    /**
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * @return mixed
     */
    public function getEnglishDesc()
    {
        return $this->englishDesc;
    }

    /**
     * @return mixed
     */
    public function getFrenchDesc()
    {
        return $this->frenchDesc;
    }

    /**
     * @param mixed $categoryId
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
    }

    /**
     * @param mixed $englishDesc
     */
    public function setEnglishDesc($englishDesc)
    {
        $this->englishDesc = $englishDesc;
    }

    /**
     * @param mixed $frenchDesc
     */
    public function setFrenchDesc($frenchDesc)
    {
        $this->frenchDesc = $frenchDesc;
    }

   
    
}

?>